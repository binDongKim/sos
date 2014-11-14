<?php
$param  = 'n14';
$API = 'http://www.football-data.org/soccerseasons/354/fixtures';
$url = $API . '?timeFrame=' . $param;
$s_data = wp_remote_get($url);
$arr_data = json_decode($s_data['body'], true);
?>

<table class="table">
  <thead>
    <tr>
      <th>Date</th>
      <th>MatchDay</th>
      <th>Home</th>
      <th>Away</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ( $arr_data as $match ) : ?>
      <tr>
        <td><?php echo $match['date']; ?></td>
        <td><?php echo $match['matchday']; ?></td>
        <td><?php echo $match['homeTeam']; ?></td>
        <td><?php echo $match['awayTeam']; ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
