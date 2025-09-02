Sub Gen_rapport()

    ' Declare variables
    Dim wordApp As Object
    Dim wordDoc As Object
    Dim lastRow As Long
    Dim ws As Worksheet
    Dim i As Integer
    Dim fileDialog As fileDialog
    Dim folderPath As String
    Dim savePath As String

    ' Set worksheet and find last row
    Set ws = ThisWorkbook.Sheets("Feuil1")
    lastRow = ws.Cells(ws.Rows.Count, "A").End(xlUp).Row

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
        .Replacement.Text = Trim(ws.Cells(lastRow, 11).Value)
        .Execute Replace:=2
    End With

    ' Loop through columns to replace placeholders
    For i = 1 To 18
        Dim headerName As String
        headerName = Trim(ws.Cells(1, i).Value)

        If headerName <> "" Then
            Dim cellValue As Variant
            cellValue = ws.Cells(lastRow, i).Value

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
    .InitialFileName = Environ("USERPROFILE") & "\Documents" ' Start in user's Documents folder

    If .Show = -1 Then
        folderPath = .SelectedItems(1)

        ' Sanitize filename
        Dim rawName As String
        Dim cleanName As String
        Dim invalidChars As Variant
        Dim charIndex As Integer

        rawName = Trim(ws.Cells(lastRow, 1).Value)
        cleanName = rawName
        invalidChars = Array("\", "/", ":", "*", "?", """", "<", ">", "|")

        For charIndex = LBound(invalidChars) To UBound(invalidChars)
            cleanName = Replace(cleanName, invalidChars(charIndex), "_")
        Next charIndex

        savePath = folderPath & "\Rapport d'essai " & cleanName & ".docx"
        wordDoc.SaveAs2 fileName:=savePath, FileFormat:=12 ' Save as .docx
    Else
        MsgBox "Save cancelled.", vbInformation
    End If
End With


    ' Clean up
    wordDoc.Close
    wordApp.Quit

End Sub


