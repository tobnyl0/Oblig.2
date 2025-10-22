<?php  /* registrer-klasse */
/*
/*  Programmet lager et html-skjema for å registrere en klasse
/*  Programmet registrerer data (klassekode og klasse) i databasen
*/
?> 

<h3>Registrer klasse </h3>

<form method="post" action="" id="registrerklasseSkjema" name="registrerklasseSkjema">
  klassekode <input type="text" id="Klassekode" name="Klassekode" required /> <br/>
  klassenavn <input type="text" id="klassenavn" name="klassenavn" required /> <br/>
  studiumkode <input type="text" id="studiumkode" name="studiumkode" required /> <br/>
  <input type="submit" value="Registrer Klassekode" id="registrerKlassekodeKnapp" name="registrerKlassekodeKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerKlassekodeKnapp"]))
    {
      $Klassekode=$_POST ["Klassekode"];
      $klassenavn=$_POST ["klassenavn"];
      $studiumkode=$_POST ["studiumkode"];

      if (!$Klassekode || !$klassenavn || !$studiumkode)
        {
          print ("B&aring;de Klassekode klassenavn og studiumkode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM Klassekode WHERE Klassekode='$Klassekode';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* klasse er registrert fra før */
            {
              print ("Klassen er registrert fra f&oslashr");
            }
          else
            {
              $sqlSetning="INSERT INTO Klassekode VALUES('$Klassekode','$klassenavn', '$studiumkode');";
              mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende klassenavn er n&aring; registrert: $Klassekode $klassenavn $studiumkode"); 
            }
        }
    }
?> 