<?php
include "db.php";
session_start();

if(!isset($_SESSION['voter'])){
    header("Location: voterlog.php");
    exit();
}

$voter_id = $_SESSION['voter'];

// Vote Submit
if(isset($_POST['vote'])){
    $cid = $_POST['candidate_id'];

    $check = $conn->query("SELECT * FROM votes WHERE voter_id='$voter_id'");

    if($check->num_rows == 0){
        $conn->query("INSERT INTO votes (voter_id, candidate_id) VALUES ('$voter_id','$cid')");
    }

    header("Location: voterdashboard.php");
    exit();
}

// Check Already Voted
$voted = $conn->query("SELECT * FROM votes WHERE voter_id='$voter_id'")->num_rows > 0;

// Candidate List
$candidates = $conn->query("SELECT * FROM candidates");
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

    <title>Voter Dashboard</title>
</head>

<body>

    <!-- NAVBAR -->
    <div class="nav" style="justify-content: space-between; padding: 0 20px;">
        <div class="logo">Voting System</div>

        <div>
            <a href="voterdashboard.php" class="anchor">Dashboard</a>
            <a href="about.php" class="anchor">About</a>
            <a href="result.php" class="anchor">Elections</a>
            <a href="logout.php" class="anchor">Logout</a>
        </div>

        <button class="theme-toggle" onclick="toggleTheme()" id="themeBtn">
            🌙 Dark
        </button>
    </div>

    <!-- DASHBOARD -->
    <div class="dashboard-container" style="grid-template-columns: 1fr;">

        <!-- VOTING SECTION -->
        <div class="dashboard-card">
            <h2>Cast Your Vote</h2>

            <div id="voteMessage" class="message"></div>

            <table>
                <tr>
                    <th>Candidate</th>
                    <th>Party</th>
                    <th>Vote</th>
                </tr>

                <?php while($row = $candidates->fetch_assoc()){ ?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['party'] ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="candidate_id" value="<?= $row['id'] ?>">
                                <button class="vote-btn" name="vote" <?= $voted ? 'disabled' : '' ?>>
                                    Vote
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- YOUR VOTE -->
        <div class="dashboard-card" style="max-width: 250px; margin: auto; width: 100%;">
            <h2 style="text-align: center;">Your Vote</h2>

            <p style="text-align:center; font-size:18px; font-weight:bold;">
                <?php
                if($voted){
                    $r = $conn->query("
                        SELECT candidates.username
                        FROM votes
                        JOIN candidates ON votes.candidate_id = candidates.id
                        WHERE votes.voter_id='$voter_id'
                    ");

                    echo $r->fetch_assoc()['username'];
                } else {
                    echo "Not voted yet";
                }
                ?>
            </p>
        </div>

    </div>
    <script src="script.js"></script>
</body>
</html>