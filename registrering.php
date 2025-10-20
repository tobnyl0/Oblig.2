<?php  /* registrer-klasse */
/*
/*  Programmet lager et html-skjema for å registrere en klasse
/*  Programmet registrerer data (klassekode og klasse) i databasen
*/
?> 

<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerklasseSkjema" name="registrerklasseSkjema">
  klassekode <input type="text" id="klassekode" name="klassekode" required /> <br/>
  klassenavn <input type="text" id="klasse" name="klasse" required /> <br/>
  stuidekode <input type="text" id="studiumkode" name="studiumkode" required /> <br/>
  <input type="submit" value="Registrer Klassekode" id="registrerKlassekodeKnapp" name="registrerKlassekodeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerKlassekodeKnapp"]))
    {
      $klassekode=$_POST ["Klassekode"];
      $klasse=$_POST ["klasse"];
      $studiumkode=$_POST ["studiumkode"];

      if (!$klassekode || !$klasse || !$studiumkode)
        {
          print ("B&aring;de Klassekode og klasse m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klassekode WHERE Klassenavn='$Klassenavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* klasse er registrert fra før */
            {
              print ("Klassen er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO klasse VALUES('$klassekode','$klasse');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende klasse er n&aring; registrert: $Klassekode $klasse"); 
            }
        }
    }
?> 