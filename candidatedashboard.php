<?php
include "db.php";
session_start();

if(!isset($_SESSION['candidate'])){
    header("Location: candlog.php");
    exit();
}

if(!isset($_SESSION['username'])){
    header("Location: candlog.php");
    exit();
}

$candidate_id = $_SESSION['candidate'];
$candidate_name = $_SESSION['username'];

$result = $conn->query("
    SELECT voters.voter_id, voters.username
    FROM votes
    JOIN voters ON votes.voter_id = voters.id
    WHERE votes.candidate_id = '$candidate_id'
");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="style.css" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <title>Candidate Panel</title>
</head>

<body>

    <!-- NAVBAR -->
    <div class="nav" style="justify-content: space-between; padding: 0 20px;">
        <div class="logo">Voting System</div>

        <div>
            <a href="candidatedashboard.php" class="anchor">Dashboard</a>
            <a href="about.html" class="anchor">About</a>
            <a href="result.php" class="anchor">Elections</a>
            <a href="logout.php" class="anchor">Logout</a>
        </div>
    </div>

    <!-- DASHBOARD -->
    <div class="dashboard-container" style="grid-template-columns: 1fr;">

        <div class="dashboard-card" style="max-width: 850px; margin: auto; width: 100%;">
            <h2 style="text-align: center;">Voters who voted for <?= $candidate_name ?></h2>

            <table>
                <tr>
                    <th>Voter ID</th>
                    <th>Name</th>
                </tr>

                <?php while($row = $result->fetch_assoc()){ ?>
                    <tr>
                        <td><?= $row['voter_id'] ?></td>
                        <td><?= $row['username'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>

</body>
</html>