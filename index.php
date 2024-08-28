<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        /* Custom CSS can go here */
        
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    PHP Calculator
                </div>
                <div class="card-body">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

                        <div class="form-group">
                            <input type="number" class="form-control" name="num01" placeholder="Number 1" required>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="operator">
                                <option value="add">+</option>
                                <option value="subtract">-</option>
                                <option value="multiply">*</option>
                                <option value="divide">/</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="number" class="form-control" name="num02" placeholder="Number 2" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Calculate</button>

                    </form>
                </div>
                <div class="card-footer">
                    <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            // value
                            $num01 = filter_input(INPUT_POST,"num01", FILTER_SANITIZE_NUMBER_FLOAT);
                            $num02 = filter_input(INPUT_POST,"num02", FILTER_SANITIZE_NUMBER_FLOAT);
                            $operator = htmlspecialchars($_POST["operator"]);

                            //error notif
                            $errors = false;

                            if(empty($num01) || empty($num02) || empty($operator))
                            {
                                echo "<h5 class='text-danger'>Please fill in all the fields!</h5>";
                                $errors = true;
                            }

                            if(!is_numeric($num01) || !is_numeric($num02))
                            {
                                echo "<h5 class='text-danger'>Input numbers only!</h5>";
                                $errors = true;
                            }

                            // calcu
                            if(!$errors)
                            {
                                $value = 0;
                                switch($operator)
                                {
                                    case "add":
                                        $value = $num01 + $num02;
                                        break;
                                    case "subtract":
                                        $value = $num01 - $num02;
                                        break;
                                    case "multiply":
                                        $value = $num01 * $num02;
                                        break;
                                    case "divide":
                                        if ($num02 == 0) {
                                            echo "<h5 class='text-danger'>Cannot divide by zero!</h5>";
                                            $errors = true;
                                        } else {
                                            $value = $num01 / $num02;
                                        }
                                        break;

                                    default:
                                        echo "<h5 class='text-danger'>Error occurred!</h5>";
                                        break;
                                }

                                if (!$errors) {
                                    echo "<h5 class='text-success'>Result: $value</h5>";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
