<?php  /* slett-klasse */
/*
/*  Programmet lager et skjema for å velge en klasse som skal slettes  
/*  Programmet sletter den valgte klassen
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettklasseSkjema" name="slettklasseSkjema" onSubmit="return bekreft()">
  klassenavn <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  <input type="submit" value="Slett klasse" name="slettklasseKnapp" id="slettklasseKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettklasseKnapp"]))
    {	
      $klassenavn=$_POST ["Klassekode"];
	  
	  if (!$klassenavn)
        {
          print ("Klassekode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klassekode WHERE klassenavn='$klassenavn';";
          $sqlResultat=mysqli_query ($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader==0)  /* klasse er ikke registrert */
            {
              print ("klassen finnes ikke");
            }
          else
            
           // Sjekk om det finnes studenter i denne klassen
    $sqlSetning = "SELECT COUNT(*) AS antall FROM student WHERE Klassekode='$Klassekode';";
    $resultat = mysqli_query($db, $sqlSetning);
    $row = mysqli_fetch_assoc($resultat);

    if ($row['antall'] > 0)
{
        print("Kan ikke slette klassen fordi den har registrerte studenter.");
} else
{
        // Slett klassen hvis ingen studenter er registrert
        $sqlSetning = "DELETE FROM Klassekode WHERE Klassekode='$Klassekode';";
        mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette klassen");
        print("Klassen $Klassekode er slettet.");
   
}
 }
    }
?>
