<?php  /* slett-klasse */
/*
/*  Programmet lager et skjema for å velge en klasse som skal slettes  
/*  Programmet sletter den valgte klassen
*/
?>

<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettklasseSkjema" name="slettklasseSkjema" onSubmit="return bekreft()">
  <label for="Klassekode">Velg klasse:</label>
  <select name="Klassekode" id="Klassekode" required>
    <?php
      include("db-tilkobling.php");
      $sql = "SELECT Klassekode FROM Klassekode ORDER BY Klassekode;";
      $resultat = mysqli_query($db, $sql);

      while ($rad = mysqli_fetch_array($resultat)) {
        $kode = $rad["Klassekode"];
        echo "<option value='$kode'>$kode</option>";
      }
    ?>
  </select>
  <br/>
  <input type="submit" value="Slett klasse" name="slettklasseKnapp" id="slettklasseKnapp" />
</form>

<?php
  if (isset($_POST["slettklasseKnapp"])) {
    $Klassekode = $_POST["Klassekode"];

    if (!$Klassekode) {
      print("Klassekode må fylles ut");
    } else {
      include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

      $sqlSetning = "SELECT * FROM Klassekode WHERE Klassekode='$Klassekode';";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
      $antallRader = mysqli_num_rows($sqlResultat); 

      if ($antallRader == 0) {
        print("Klassen finnes ikke");
      } else {
        // Sjekk om det finnes studenter i denne klassen
        $sqlSetning = "SELECT COUNT(*) AS antall FROM student WHERE Klassekode='$Klassekode';";
        $resultat = mysqli_query($db, $sqlSetning);
        $row = mysqli_fetch_assoc($resultat);

        if ($row['antall'] > 0) {
          print("Kan ikke slette klassen fordi den har registrerte studenter.");
        } else {
          // Slett klassen hvis ingen studenter er registrert
          $sqlSetning = "DELETE FROM Klassekode WHERE Klassekode='$Klassekode';";
          mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette klassen");
          print("Klassen $Klassekode er slettet.");
        }
      }
    }
  }
?>