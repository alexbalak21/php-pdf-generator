Sub Gen_rapport()

    Dim wordApp As Object
    Dim wordDoc As Object
    Dim lastRow As Long
    Dim ws As Worksheet
    Dim i As Integer

    Set ws = ThisWorkbook.Sheets("Feuil1")
    lastRow = ws.Cells(ws.Rows.Count, "A").End(xlUp).Row

    Set wordApp = CreateObject("Word.Application")
    wordApp.Visible = True
    Set wordDoc = wordApp.Documents.Open("D:\Rapports\repport_template.docx")

    With wordDoc.Content.Find
        .ClearFormatting
        .Replacement.ClearFormatting
        .Text = "{today_date}"
        .Replacement.Text = Format(Date, "dd\/mm\/yyyy")
        .Execute Replace:=2
    End With

    With wordDoc.Content.Find
        .ClearFormatting
        .Replacement.ClearFormatting
        .Text = "{name}"
        .Replacement.Text = Trim(ws.Cells(lastRow, 11).Value)
        .Execute Replace:=2
    End With

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

    wordDoc.SaveAs "D:\Rapports\Rapport d'essai " & Trim(ws.Cells(lastRow, 1).Value) & ".docx"
    wordDoc.Close
    wordApp.Quit

End Sub
