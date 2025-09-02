Sub Gen_rapport()

    ' Declare variables
    Dim wordApp As Object
    Dim wordDoc As Object
    Dim ws As Worksheet
    Dim i As Integer
    Dim fileDialog As fileDialog
    Dim folderPath As String
    Dim savePath As String
    Dim rawName As String
    Dim cleanName As String
    Dim invalidChars As Variant
    Dim charIndex As Integer
    Dim userRow As Variant
    Dim reportCol As Integer

    ' Ask user for the row number
    userRow = InputBox("Enter the row number to generate the report from:", "Select Data Row")

    If Not IsNumeric(userRow) Or userRow < 2 Then
        MsgBox "Invalid row number. Please enter a number greater than 1.", vbExclamation
        Exit Sub
    End If

    ' Set worksheet
    Set ws = ThisWorkbook.Sheets("Feuil1")

    ' Launch Word and open template
    Set wordApp = CreateObject("Word.Application")
    wordApp.Visible = True
    Set wordDoc = wordApp.Documents.Open("D:\Rapports\repport_template.docx")

    ' Replace {today_date} placeholder
    With wordDoc.Content.Find
        .ClearFormatting
        .Replacement.ClearFormatting
        .Text = "{today_date}"
        .Replacement.Text = Format(Date, "dd\/mm\/yyyy")
        .Execute Replace:=2
    End With

    ' Replace {name} placeholder
    With wordDoc.Content.Find
        .ClearFormatting
        .Replacement.ClearFormatting
        .Text = "{name}"
        .Replacement.Text = Trim(ws.Cells(userRow, 11).Value)
        .Execute Replace:=2
    End With

    ' Loop through columns to replace placeholders
    For i = 2 To 19
        Dim headerName As String
        headerName = Trim(ws.Cells(1, i).Value)

        If headerName <> "" Then
            Dim cellValue As Variant
            cellValue = ws.Cells(userRow, i).Value

            If IsDate(cellValue) Then
                cellValue = Format(cellValue, "dd\/mm\/yy")
            Else
                cellValue = Trim(cellValue)
            End If

            With wordDoc.Content.Find
                .ClearFormatting
                .Replacement.ClearFormatting
                .Text = "{" & headerName & "}"
                .Replacement.Text = cellValue
                .Execute Replace:=2
            End With
        End If
    Next i

    ' Prompt user to select a folder
    Set fileDialog = Application.fileDialog(msoFileDialogFolderPicker)
    With fileDialog
        .Title = "Select Folder to Save Report"
        .InitialFileName = Environ("USERPROFILE") & "\Documents"

        If .Show = -1 Then
            folderPath = .SelectedItems(1)

            ' Find the column labeled "Numéro Rapport"
            reportCol = 0
            For i = 1 To ws.Cells(1, ws.Columns.Count).End(xlToLeft).Column
                If Trim(ws.Cells(1, i).Value) = "Numéro Rapport" Then
                    reportCol = i
                    Exit For
                End If
            Next i

            If reportCol = 0 Then
                MsgBox """Numéro Rapport"" column not found.", vbCritical
                Exit Sub
            End If

            ' Sanitize filename
            rawName = Trim(ws.Cells(userRow, reportCol).Value)
            cleanName = rawName
            invalidChars = Array("\", "/", ":", "*", "?", """", "<", ">", "|")

            For charIndex = LBound(invalidChars) To UBound(invalidChars)
                cleanName = Replace(cleanName, invalidChars(charIndex), "_")
            Next charIndex

            ' Build save path and save document
            savePath = folderPath & "\Rapport d'essai " & cleanName & ".docx"
            wordDoc.SaveAs2 fileName:=savePath, FileFormat:=12
        Else
            MsgBox "Save cancelled.", vbInformation
        End If
    End With

    ' Clean up
    wordDoc.Close
    wordApp.Quit

End Sub

