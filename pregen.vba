Sub Pregen()

    Dim ws As Worksheet
    Dim lastRow As Long
    Dim reportCol As Integer
    Dim i As Long
    Dim todayPrefix As String
    Dim maxN As Long
    Dim currentVal As String
    Dim suffix As String
    Dim newValue As String

    ' Set worksheet
    Set ws = ThisWorkbook.Sheets("Feuil1")

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

    ' Build today's prefix
    todayPrefix = "NOVOCIB " & Format(Date, "yymmdd") & "-"

    ' Loop through the column to find max n for today's prefix
    maxN = 0
    For i = 2 To ws.Cells(ws.Rows.Count, reportCol).End(xlUp).Row
        currentVal = Trim(ws.Cells(i, reportCol).Value)
        If Left(currentVal, Len(todayPrefix)) = todayPrefix Then
            suffix = Mid(currentVal, Len(todayPrefix) + 1)
            If IsNumeric(suffix) Then
                If CLng(suffix) > maxN Then maxN = CLng(suffix)
            End If
        End If
    Next i
    
    ' Generate new value
    newValue = todayPrefix & (maxN + 1)

    ' Write to next empty row
    lastRow = ws.Cells(ws.Rows.Count, reportCol).End(xlUp).Row + 1
    ws.Cells(lastRow, reportCol).Value = newValue

End Sub

