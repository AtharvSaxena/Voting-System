<?php
include "db.php";
session_start();

$dashboard = "index.php";

if(isset($_SESSION['role'])){
    if($_SESSION['role'] == 'voter'){
        $dashboard = "voterdashboard.php";
    }
    elseif($_SESSION['role'] == 'candidate'){
        $dashboard = "candidatedashboard.php";
    }
    elseif($_SESSION['role'] == 'admin'){
        $dashboard = "admindashboard.php";
    }
}

$sql = "
SELECT candidates.username, candidates.party, COUNT(votes.id) as total_votes
FROM candidates
LEFT JOIN votes ON candidates.id = votes.candidate_id
GROUP BY candidates.id
ORDER BY total_votes DESC
";

$result = $conn->query($sql);
$total = $conn->query("SELECT COUNT(*) as t FROM votes")->fetch_assoc()['t'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

      <link rel="stylesheet" href="style.css" />

    <title>Result Dashboard</title>

    
  </head>

  <body>
    <!-- NAVBAR -->
    <div class="nav" style="justify-content: space-between; padding: 10px 50px;">
      <div class="logo">Voting System</div>

      <div>
        <a href="<?= $dashboard ?>" class="anchor">Dashboard</a>
        <a href="about.html" class="anchor">About</a>
        <a href="result.php" class="anchor">Elections</a>
        <a href="logout.php" class="anchor">Logout</a>
      </div>
    </div>

    <!-- RESULTS -->
    <div class="container">
      <div class="res-card">
        <h2>Election Results</h2>

        <table>
          <tr>
            <th>Candidate</th>
            <th>Party</th>
            <th>Total Votes</th>
            <th>Percentage</th>
            <th>Status</th>
          <?php $rank=0; while($row = $result->fetch_assoc()){ $rank++; 
            $percent = $total ? ($row['total_votes']/$total)*100 : 0; ?>
            <tr class="<?= $rank==1 ? 'winner' : '' ?>">
              <td><?= $row['username'] ?></td>
              <td><?= $row['party'] ?></td>
              <td><?= $row['total_votes'] ?></td>
              <td>
                <div class="bar">
                  <div class="fill" style="width: <?= $percent ?>%"></div>
                </div>
                <?= round($percent,1) ?>%
              </td>
              <td><?= $rank==1 ? '<span class="badge">Winner</span>' : '-' ?></td>
            </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </body>
</html>
