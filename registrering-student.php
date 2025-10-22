<?php  /* slett-student */
/*
/*  Programmet lager et skjema for å velge en registrert student som skal slettes  
/*  Programmet sletter den valgte studenten
*/
?>

<script src="funksjoner.js"> </script>

<h3>Slett student</h3>

<form method="post" action="" id="slettstudentSkjema" name="slettstudentSkjema" onSubmit="return bekreft()">
  <label for="brukernavn">Velg registrert student:</label>
  <select name="brukernavn" id="brukernavn" required>
    <?php
      include("db-tilkobling.php");
      $sql = "SELECT brukernavn, fornavn, etternavn FROM student ORDER BY etternavn, fornavn;";
      $resultat = mysqli_query($db, $sql);

      while ($rad = mysqli_fetch_array($resultat)) {
        $brukernavn = $rad["brukernavn"];
        $navn = $rad["etternavn"] . ", " . $rad["fornavn"];
        echo "<option value='$brukernavn'>$navn ($brukernavn)</option>";
      }
    ?>
  </select>
  <br/>
  <input type="submit" value="Slett student" name="slettstudentKnapp" id="slettstudentKnapp" />
</form>

<?php
  if (isset($_POST["slettstudentKnapp"])) {
    $brukernavn = $_POST["brukernavn"];

    if (!$brukernavn) {
      print("Du må velge en student.");
    } else {
      include("db-tilkobling.php");

      $sqlSetning = "SELECT * FROM student WHERE brukernavn='$brukernavn';";
      $sqlResultat = mysqli_query($db, $sqlSetning) or die("Ikke mulig å hente data fra databasen");
      $antallRader = mysqli_num_rows($sqlResultat); 

      if ($antallRader == 0) {
        print("Studenten finnes ikke.");
      } else {
        $sqlSetning = "DELETE FROM student WHERE brukernavn='$brukernavn';";
        mysqli_query($db, $sqlSetning) or die("Ikke mulig å slette data i databasen");
        print("Følgende student er nå slettet: $brukernavn<br />");
      }
    }
  }
?>