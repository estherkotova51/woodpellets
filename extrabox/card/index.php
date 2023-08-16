<!doctype html>
<html>

<head>
    <?php include_once('headsection.php'); ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="extrabox/card/assets2/css/styles.css">
    <!-- <link rel="stylesheet" type="text/css" href="/assets/css/demo.css"> -->
</head>

<body>
    <div class="container-fluid">
        <div class="creditCardForm">
<!--             <div class="heading">
                <h1>Confirm Purchase</h1>
            </div> -->
            <div class="payment">
                <!-- <form action="#" method="POST"> -->
                    <div class="form-group owner">
                        <label for="owner">Owner</label>
                        <input type="text" class="form-control" id="owner" required>
                    </div>
                    <div class="form-group" id="card-number-field">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" required>
                    </div>
                    <div class="form-group CVV" id="cvv-number-field">
                        <label for="cvv">CVV</label>
                        <input type="text" class="form-control" id="cvv" required>
                    </div>
                    <div class="form-group" id="credit_cards">
                        <img src="extrabox/card/assets2/images/visa.jpg" id="visa">
                        <img src="extrabox/card/assets2/images/mastercard.jpg" id="mastercard">
                        <img src="extrabox/card/assets2/images/amex.jpg" id="amex">
                    </div>
                    <div class="form-group" id="expiration-date">
                        <label>Expiration Date</label>
                        <select id="monthcard" name="monthcard">
                            <?php 
                                $month = date("m"); 
                                $monthl = date("F");

                                $months = array("01" => "January", "02" => "February", "03" => "March", "04" => "April", "05" => "May","06" => "June", "07" => "July", "08" => "August", "09" => "September", "10" => "October", "11" => "November", "12" => "December");

                                foreach($months as $key => $values) {
                                    if($values == $monthl){
                                        echo "<option value=\"$key\" selected>$values</option>";
                                    }else{
                                        echo "<option value=\"$key\">$values</option>";
                                    }
                                    
                                }

                            ?>
                        </select>
                        <select id="yearcard" name="yearcard">
                            <?php 
                                $year = date("Y"); 
                                $years = $year+10;
                                for ($i=$year; $i < $years; $i++) { ?>

                                    <option value="<?php $yeardigits = str_split($i, 2); echo $yeardigits[1]; ?>"> <?php echo $i; ?></option>
                                    
                              <?php  }

                            ?>
                            
                        </select>
                    </div>
                    
                    <div class="form-group" id="pay-now">
                        <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm</button>
                    </div>
                <!-- </form> -->
            </div>
        </div>

    </div>
    <script src="code.jquery.com/jquery-1.11.2.min.js"></script>
    <!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <script src="extrabox/card/assets2/js/jquery.payform.min.js" charset="utf-8"></script>
    <script src="extrabox/card/assets2/js/payform.min.js"></script>
    <script src="extrabox/card/assets2/js/script.js"></script>
    
</body>

</html>
