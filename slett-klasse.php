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