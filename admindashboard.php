<?php
include "db.php";
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: adminlog.php");
    exit();
}

// Remove Candidate
if(isset($_GET['remove_candidate'])){
    $id = $_GET['remove_candidate'];
    $conn->query("DELETE FROM candidates WHERE id='$id'");
}

// Remove Voter
if(isset($_GET['remove_voter'])){
    $id = $_GET['remove_voter'];
    $conn->query("DELETE FROM voters WHERE id='$id'");
}
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

    <title>Admin Dashboard</title>
</head>

<body>

    <!-- NAVBAR -->
    <div class="nav" style="justify-content: space-between; padding: 0 20px;">
        <div class="logo">Voting System</div>

        <div>
            <a href="admindashboard.php" class="anchor">Dashboard</a>
            <a href="about.php" class="anchor">About</a>
            <a href="result.php" class="anchor">Elections</a>
            <a href="logout.php" class="anchor">Logout</a>
        </div>
    </div>

    <!-- DASHBOARD -->
    <div class="dashboard-container">

        <!-- CANDIDATE LIST -->
        <div class="dashboard-card">
            <h2>Candidate List</h2>

            <table>
                <tr>
                    <th>Name</th>
                    <th>Party</th>
                    <th>Action</th>
                </tr>

                <?php
                $c = $conn->query("SELECT * FROM candidates");

                while($row = $c->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['party'] ?></td>
                        <td>
                            <a href="?remove_candidate=<?= $row['id'] ?>" class="action-btn remove">
                                Remove
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- VOTER DETAILS -->
        <div class="dashboard-card">
            <h2>Voter Details</h2>

            <table>
                <tr>
                    <th>Voter ID</th>
                    <th>Name</th>
                    <th>Voted Candidate</th>
                    <th>Action</th>
                </tr>

                <?php
                $v = $conn->query("
                    SELECT voters.*, candidates.username as voted_for
                    FROM voters
                    LEFT JOIN votes ON voters.id = votes.voter_id
                    LEFT JOIN candidates ON votes.candidate_id = candidates.id
                ");

                while($row = $v->fetch_assoc()){
                ?>
                    <tr>
                        <td><?= $row['voter_id'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['voted_for'] ?? 'None' ?></td>
                        <td>
                            <a href="?remove_voter=<?= $row['id'] ?>" class="action-btn remove">
                                Remove
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>

</body>
</html>