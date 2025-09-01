Sub Button_1()

    ' Déclare les objets Word
    Dim wordApp As Object
    Dim wordDoc As Object

    ' Variables pour la dernière ligne et la feuille Excel
    Dim lastRow As Long
    Dim ws As Worksheet
    Dim i As Integer

    ' Définit la feuille active (à adapter si nécessaire)
    Set ws = ThisWorkbook.Sheets("Feuil1")

    ' Trouve le numéro de la dernière ligne remplie dans la colonne A
    lastRow = ws.Cells(ws.Rows.Count, "A").End(xlUp).Row

    ' Crée une instance de l'application Word
    Set wordApp = CreateObject("Word.Application")
    wordApp.Visible = True ' Affiche Word pour que tu voies le document

    ' Ouvre le modèle Word (à adapter avec le bon chemin)
    Set wordDoc = wordApp.Documents.Open("D:\Rapports\repport_template.docx")

    With wordDoc.Content.Find
        .ClearFormatting
        .Replacement.ClearFormatting
        .Text = "{today_date}"
        .Replacement.Text = Format(Date, "dd\/mm\/yyyy")
        .Execute Replace:=2 ' 2 = wdReplaceAll
    End With
    
    ' Remplacements dynamiques de {1} à {18}
    For i = 1 To 18
        With wordDoc.Content.Find
            .Text = "{" & i & "}"
            .Replacement.Text = ws.Cells(lastRow, i).Value
            .Execute Replace:=2
        End With
    Next i

    ' Enregistre le document Word avec un nom basé sur le numéro de rapport
    wordDoc.SaveAs "D:\Rapports\Rapport_" & ws.Cells(lastRow, 1).Value & ".docx"

    ' Ferme le document Word
    wordDoc.Close

    ' Ferme l'application Word
    wordApp.Quit

End Sub

