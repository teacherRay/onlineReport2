<!DOCTYPE html>
<html>
    <head>
        <title>PHP CRUD</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'process.php'; ?>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
        <div class="container">
        <?php
            $mysqli = new mysqli("localhost","ray","password","crud") or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
            //pre_r($result);
            ?>
        
            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Classroom</th>
                            <th>Participation</th>
                            <th>Behavior</th>
                            <th>Conversation</th>
                            <th>Comprehension</th>
                            <th>Homework</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
            <?php
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['classroom']; ?></td>
                        <td><?php echo $row['pa_part']; ?></td>
                        <td><?php echo $row['pa_bev']; ?></td>
                        <td><?php echo $row['pa_conversation']; ?></td>
                        <td><?php echo $row['pa_comprehension']; ?></td>
                        <td><?php echo $row['pa_homework']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                               class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>"
                               class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>    
                </table>
            </div>
            <?php
            
            function pre_r( $array ) {
                echo '<pre>';
                print_r($array);
                echo '</pre>';
            }
        ?>
        
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" 
                   value="<?php echo $name; ?>">
            </div>

            <div class="form-group">
            <label>Classroom</label>
            <input type="text" name="classroom" 
                   value="<?php echo $classroom; ?>" class="form-control>
            </div>

            <div class="form-group">
            <label>Participation</label>
            <input type="number" name="pa_part" 
                   value="<?php echo $pa_part; ?>" class="form-control>
            </div>
            
            <div class="form-group">
            <label>Behavior</label>
            <input type="number" name="pa_bev" 
                   value="<?php echo $pa_bev; ?>" class="form-control">
            </div>

            <div class="form-group">
            <label>Conversation</label>
            <input type="number" name="pa_conversation" 
                   value="<?php echo $pa_conversation; ?>" class="form-control">
            </div>
            
            <div class="form-group">
            <label>Comprehension</label>
            <input type="number" name="pa_comprehension" 
                   value="<?php echo $pa_comprehension; ?>" class="form-control">
            </div>
            
            <div class="form-group">
            <label>Homework</label>
            <input type="number" name="pa_homework" 
                   value="<?php echo $pa_homework; ?>" class="form-control">
            </div>



            <div class="form-group">
            <?php 
            if ($update == true): 
            ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>
        </form>
        </div>
        </div>
    </body>