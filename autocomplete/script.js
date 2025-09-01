const species = ["Salmon", "Tuna", "Trout", "Herring", "Mackerel"];
const speciesInput = document.getElementById('species');
const suggestionBox = document.getElementById('autocomplete-list');

speciesInput.addEventListener('input', function () {
  const value = this.textContent.trim();
  suggestionBox.innerHTML = '';

  if (!value) {
    suggestionBox.style.display = 'none';
    return;
  }

  const suggestions = species.filter(s =>
    s.toLowerCase().startsWith(value.toLowerCase())
  );

  if (suggestions.length === 0) {
    suggestionBox.style.display = 'none';
    return;
  }

  // Position dropdown relative to the cell
  const rect = speciesInput.getBoundingClientRect();
  suggestionBox.style.top = `${rect.bottom + window.scrollY}px`;
  suggestionBox.style.left = `${rect.left + window.scrollX}px`;
  suggestionBox.style.display = 'block';

  suggestions.forEach(s => {
    const item = document.createElement('div');
    item.textContent = s;
    item.addEventListener('mousedown', function () {
      speciesInput.textContent = s;
      suggestionBox.innerHTML = '';
      suggestionBox.style.display = 'none';
    });
    suggestionBox.appendChild(item);
  });
});




// Hide dropdown when clicking outside
document.addEventListener('click', function (e) {
  if (e.target !== speciesInput) {
    suggestionBox.innerHTML = '';
    suggestionBox.style.display = 'none';
  }
});
