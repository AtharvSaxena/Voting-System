<?php
include "db.php";
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: adminlog.php");
    exit();
}

// remove
if(isset($_GET['remove_candidate'])){
    $id=$_GET['remove_candidate'];
    $conn->query("DELETE FROM candidates WHERE id='$id'");
}

if(isset($_GET['remove_voter'])){
    $id=$_GET['remove_voter'];
    $conn->query("DELETE FROM voters WHERE id='$id'");
}
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

    <title>Admin Dashboard</title>

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Segoe UI", sans-serif;
      }

      /* BACKGROUND */
      body {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        min-height: 100vh;
      }

      /* NAVBAR */
      .nav {
        height: 65px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 30px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      }

      .logo {
        color: white;
        font-size: 22px;
        font-weight: bold;
      }

      .link {
        display: flex;
        gap: 25px;
        align-items: center;
      }

      .anchor {
        color: white;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 20px;
        transition: 0.3s;
      }

      .anchor:hover {
        background: white;
        color: #4facfe;
      }

      /* DROPDOWN */
      .dropdown {
        position: relative;
      }

      .dropdown-btn {
        color: white;
        cursor: pointer;
        padding: 8px 15px;
        border-radius: 20px;
      }

      .dropdown-btn:hover {
        background: white;
        color: #4facfe;
      }

      .dropdown-content {
        display: none;
        position: absolute;
        top: 40px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        min-width: 150px;
      }

      .dropdown-content a {
        display: block;
        padding: 10px;
        color: #333;
        text-decoration: none;
      }

      .dropdown-content a:hover {
        background: #4facfe;
        color: white;
      }

      .dropdown:hover .dropdown-content {
        display: block;
      }

      /* GRID */
      .container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        padding: 40px;
      }

      /* CARD */
      .card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      }

      .card h2 {
        margin-bottom: 15px;
        color: #4facfe;
      }

      /* TABLE */
      table {
        width: 100%;
        border-collapse: collapse;
      }

      th,
      td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
      }

      th {
        background: #4facfe;
        color: white;
      }

      tr:hover {
        background: #f1f1f1;
      }

      /* BUTTONS */
      .btn {
        padding: 6px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: white;
        font-size: 12px;
        margin: 2px;
      }

      .accept {
        background: #28a745;
      }

      .reject {
        background: #dc3545;
      }

      .remove {
        background: #343a40;
      }

      .btn:hover {
        opacity: 0.8;
      }

      /* RESPONSIVE */
      @media (max-width: 768px) {
        .container {
          grid-template-columns: 1fr;
        }
      }
    </style>
  </head>

  <body>
    <!-- NAVBAR -->
    <div class="nav">
      <div class="logo">Voting System</div>

      <div>
        <a href="admindashboard.php" class="anchor">Dashboard</a>
        <a href="about.html" class="anchor">About</a>
        <a href="result.php" class="anchor">Elections</a>
        <a href="logout.php" class="anchor">Logout</a>
      </div>
    </div>

    <!-- DASHBOARD -->
    <div class="container">
      <!-- CANDIDATE -->
      <div class="card">
        <h2>Candidate List</h2>
        <table>
          <tr>
            <th>Name</th>
            <th>Party</th>
            <th>Action</th>
          </tr>

        
          <?php $c=$conn->query("SELECT * FROM candidates");
          while($row=$c->fetch_assoc()){ ?>
            <tr>
              <td><?= $row['username'] ?></td>
              <td><?= $row['party'] ?></td>
               <td>
                <a href="?remove_candidate=<?= $row['id'] ?>" class="btn remove">Remove</a>
              </td>
            </tr>
          <?php } ?>
        </table>
      </div>

      <!-- VOTER -->
      <div class="card">
        <h2>Voter Details</h2>
        <table>
          <tr>
            <th>Voter ID</th>
            <th>Name</th>
            <th>Voted Candidate</th>
            <th>Action</th>
          </tr>

          <?php
            $v=$conn->query(" SELECT voters.*, candidates.username as voted_for
                              FROM voters
                              LEFT JOIN votes ON voters.id=votes.voter_id
                              LEFT JOIN candidates ON votes.candidate_id=candidates.id
                            ");

            while($row=$v->fetch_assoc()){ ?>
              <tr>
                <td><?= $row['voter_id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['voted_for']??'None' ?></td>
                <td>
                  <a href="?remove_voter=<?= $row['id'] ?>" class="btn remove">Remove</a>
                </td>
              </tr>
            <?php } ?>
        </table>
      </div>
    </div>
  </body>
</html>
