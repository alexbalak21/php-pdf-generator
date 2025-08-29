// Handle analysis table functionality
document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('http://localhost:8000/api/echantillon-analyses', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(`HTTP error! status: ${response.status}`, { cause: errorData });
        }

        const result = await response.json();
        console.log('Fetched data from API:');
        displayData(result.data);
    } catch (error) {
        console.error('Error fetching data from API:', error);
        if (error.cause) {
            console.error('Error details:', error.cause);
        }
    }

    // Helper functions
    function normalizeField(label) {
        return label.toLowerCase()
            .replace(/ /g, '_')
            .replace(/[éèê]/g, 'e')
            .replace(/[àâ]/g, 'a')
            .replace(/[ùû]/g, 'u')
            .replace(/[îï]/g, 'i')
            .replace(/[ôö]/g, 'o')
            .replace(/[ç]/g, 'c')
            .replace(/[^a-z_]/g, '');
    }

    function isDateField(field) {
        return ['date_heure_prelevement', 'date_heure_reception', 'date_mise_en_analyse'].includes(field);
    }

    function formatDate(value) {
        try {
            const [datePart, timePart = '00:00'] = value.split(' ');
            const [day, month, year] = datePart.split('/');

            if (day && month && year) {
                const formattedYear = year.length === 4 ? year.slice(-2) : year;
                const formattedDate = `${day.padStart(2, '0')}/${month.padStart(2, '0')}/${formattedYear}`;
                const [hours, minutes = '00'] = timePart.split(':');
                return `${formattedDate} ${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}`;
            } else {
                const date = new Date(value);
                if (!isNaN(date.getTime())) {
                    const d = String(date.getDate()).padStart(2, '0');
                    const m = String(date.getMonth() + 1).padStart(2, '0');
                    const y = String(date.getFullYear()).slice(-2);
                    const h = String(date.getHours()).padStart(2, '0');
                    const min = String(date.getMinutes()).padStart(2, '0');
                    return `${d}/${m}/${y} ${h}:${min}`;
                }
            }
        } catch (e) {
            console.warn(`Could not format date:`, value);
        }
        return value;
    }

    function showStatus(message, type = 'info') {
        const statusDiv = document.getElementById('saveStatus');
        if (!statusDiv) return;

        const alert = document.createElement('div');
        alert.className = `alert alert-${type} alert-dismissible fade show`;
        alert.role = 'alert';
        alert.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        statusDiv.appendChild(alert);

        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150);
        }, 5000);
    }

    // Main display and save logic
    function displayData(data) {
        const tbody = document.querySelector('#editableTable tbody');
        const templateRow = tbody.querySelector('tr');
        templateRow.querySelectorAll('td').forEach(cell => {
            cell.contentEditable = 'true';
        });

        tbody.innerHTML = '';
        console.log(data);
        
        const newRow = templateRow.cloneNode(true);
       data.forEach(item => {
         newRow.querySelectorAll('td').forEach(cell => {
            const dataLabel = cell.dataset.label;
            cell.innerText = item[dataLabel] || '';
        });
        tbody.appendChild(newRow);
    });

        

        const saveBtn = document.getElementById('saveBtn');
        if (!saveBtn) return;

        saveBtn.addEventListener('click', async function () {
            const rows = document.querySelectorAll('#editableTable tbody tr');
            const payload = [];

            rows.forEach(row => {
                const cells = row.querySelectorAll('td[contenteditable="true"]');
                const rowData = {};
                let isEmpty = true;

                cells.forEach(cell => {
                    const field = normalizeField(cell.dataset.label);
                    let value = cell.textContent.trim();

                    if (isDateField(field) && value) {
                        value = formatDate(value);
                    }

                    if (value) {
                        rowData[field] = value;
                        isEmpty = false;
                    }
                });

                if (!isEmpty) {
                    payload.push(rowData);
                }
            });

            if (payload.length === 0) {
                showStatus('Aucune donnée à enregistrer', 'warning');
                return;
            }

            try {
                saveBtn.disabled = true;
                saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Enregistrement...';

                console.log('Data being sent to server:');
                console.log(JSON.stringify(payload, null, 2));

                const response = await fetch('/api/echantillon-analyses', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (response.ok) {
                    const successMsg = `${result.created_count} enregistrement(s) créé(s) avec succès`;
                    showStatus(successMsg, 'success');

                    if (result.created_count > 0) {
                        setTimeout(() => {
                            document.querySelectorAll('#editableTable tbody tr').forEach(row => {
                                row.querySelectorAll('td[contenteditable="true"]').forEach(cell => {
                                    cell.textContent = '';
                                });
                            });
                        }, 1500);
                    }
                } else {
                    const errorMsg = result.message || 'Erreur lors de l\'enregistrement';
                    showStatus(errorMsg, 'danger');

                    if (result.errors) {
                        result.errors.forEach(error => {
                            showStatus(`Ligne ${error.index + 1}: ${error.message}`, 'danger');
                        });
                    }
                }
            } catch (error) {
                console.error('Error:', error);
                showStatus('Une erreur est survenue: ' + error.message, 'danger');
            } finally {
                saveBtn.disabled = false;
                saveBtn.innerHTML = '<i class="fas fa-save me-2"></i>Enregistrer';
            }
        });
    }
});


