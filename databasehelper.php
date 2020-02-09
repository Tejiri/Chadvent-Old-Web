<?php

session_start();

function checkgeneral($name, $password)
{
    $connection = mysqli_connect("localhost", "root", "", "chadvent");

    $username = $name;
    $password = $password;
    $query1 = "select * from userdetails";
    $query2 = "select news from latest_news";
    $result = mysqli_query($connection, $query1);
    $newsresult = mysqli_query($connection, $query2);
    $fulldatabase = mysqli_fetch_all($result);
    $news = mysqli_fetch_array($newsresult);
    $_SESSION['broadcastnews'] = $news['news'];

    if ($username == "admin" && $password == "chadvent") {
        $_SESSION['admin'] = "Admin";
        header("Location: admin.php");
    } else {
        foreach ($fulldatabase as $key => $value) {
            $nextArray = $fulldatabase[$key];
            //  print_r($nextArray);
            if ($username == $nextArray[1] && $password == $nextArray[2]) {
                //   echo "Found You";
                $_SESSION['username'] = $nextArray[1];

                //echo $_SESSION['occupation'];
                header("Location: profile.php");
            } else if ($key + 1 == count($fulldatabase)) {
                echo "Details not found, please check username and password entered";
            }
        }
    }
}

function insert(
    $username,
    $password,
    $firstname,
    $lastname,
    $position,
    $membershipstatus,
    $totalsavings,
    $loanaccount,
    $lasttransaction,
    $loanapplicationstatus,
    $phonenumber,
    $email,
    $address,
    $gender,
    $occupation
) {
    $usernamesinarray = [];
    $connection = mysqli_connect("localhost", "root", "", "chadvent");
    $testing = strtolower($username . "_statement");
    $query3 = "select username from userdetails";
    $execute = mysqli_query($connection, $query3);
    $full = mysqli_fetch_all($execute);

    foreach ($full as $key => $value) {
        $nextArray = $full[$key];
        array_push($usernamesinarray, $nextArray[0]);
    }

    if (in_array($username, $usernamesinarray)) {
      echo "<script>alert('Username $username already exists, change the username or delete the member that currently holds that username');</script>";
      
    } else {
        $query1 = "create table $testing(id int primary key not null auto_increment, date varchar(255), narration varchar(255), debit varchar(255), credit varchar(255), balance varchar(255))";
        $query2 = "insert into userdetails(username, password, firstname, lastname, position, membership_status, total_savings,
            loan_account, last_transaction, loan_application_status, phonenumber, email, address, gender,
            occupation,profile_picture) values('$username', '$password', '$firstname', '$lastname', '$position', '$membershipstatus', '$totalsavings',
            '$loanaccount', '$lasttransaction', '$loanapplicationstatus', '$phonenumber', '$email',
            '$address', '$gender', '$occupation','logo.png')";
        mysqli_query($connection, $query1);
        mysqli_query($connection, $query2);
        header("Location: admin.php");
    }
}

function update(
    $id1,
    $username,
    $password,
    $firstname,
    $lastname,
    $position,
    $membershipstatus,
    // $totalsavings,
    $loanaccount,
    //$lasttransaction,
    $loanapplicationstatus,
    $phonenumber,
    $email,
    $address,
    $gender,
    $occupation
) {

    $connection = mysqli_connect("localhost", "root", "", "chadvent");

    $query = "update userdetails set username = '$username', password = '$password', firstname = '$firstname',lastname = '$lastname',
    position = '$position',membership_status = '$membershipstatus', loan_account = '$loanaccount',
     loan_application_status = '$loanapplicationstatus', phonenumber = '$phonenumber',
    email = '$email', address = '$address', gender = '$gender', occupation = '$occupation'
    where id= '$id1'";
    mysqli_query($connection, $query);
}

function delete($id1)
{
    $connection = mysqli_connect("localhost", "root", "", "chadvent");
    $query1 = "select username from userdetails where  id = '$id1'";
    $execute = mysqli_query($connection, $query1);
    $array = mysqli_fetch_assoc($execute);
    $username = $array['username'];
    $userstatementtable = strtolower($username . "_statement");
    $dropstatementtablequery = "drop table $userstatementtable";
    mysqli_query($connection, $dropstatementtablequery);
    $query5 = "delete from userdetails where id='$id1'";
    mysqli_query($connection, $query5);
}

function credit($username, $creditamount, $date)
{
    //  echo $username;
    $connectiontry = mysqli_connect("localhost", "root", "", "chadvent");
    if ($username == "") {
    } else {
        $words = "Credit of ₦" . $creditamount;
        $totalsave = "₦" . $creditamount;
        $updatelasttransaction = "update userdetails set last_transaction = '$words' where username = '$username'";
        $updatetotalsavings = "update userdetails set total_savings = '$totalsave' where username = '$username'";
        mysqli_query($connectiontry, $updatelasttransaction);
        mysqli_query($connectiontry, $updatetotalsavings);
        $testing = strtolower($username . "_statement");
        $countquery1 = "select count(*) from $testing";
        $result = mysqli_query($connectiontry, $countquery1);
        $array = mysqli_fetch_array($result);
        $finalcount = $array['count(*)'];
        if ($finalcount == 0) {
            $query = "INSERT INTO `$testing`(`date`, `narration`, `debit`, `credit`, `balance`) VALUES ('$date','Account Credited',0,'$creditamount','$creditamount')";
            mysqli_query($connectiontry, $query);
        } else {
            $words = "Credit of ₦" . $creditamount;
            $updatelasttransaction = "update userdetails set last_transaction = '$words' where username = '$username'";
            mysqli_query($connectiontry, $updatelasttransaction);

            //count all in database and return last index
            $countquery1 = "select count(*) from $testing";
            $resultofcount = mysqli_query($connectiontry, $countquery1);
            $arrayofcount = mysqli_fetch_array($resultofcount);
            $indexoflast = $arrayofcount['count(*)'] - 1;


            $fulldata = "select * from $testing";
            $execute = mysqli_query($connectiontry, $fulldata);
            $arrayofeverything = mysqli_fetch_all($execute);
            $lasttransaction = $arrayofeverything[$indexoflast];
            $lastbalance = $lasttransaction[5];
            $totalsavings = $lastbalance + $creditamount;
            $totalsave = "₦" . $totalsavings;
            $updatetotalsavings = "update userdetails set total_savings = '$totalsave' where username = '$username'";
            mysqli_query($connectiontry, $updatetotalsavings);
            $secondquery = "INSERT INTO `$testing`(`date`, `narration`, `debit`, `credit`, `balance`) VALUES ('$date','Account Credited',0,'$creditamount','$totalsavings')";
            mysqli_query($connectiontry, $secondquery);
        }
    }
}

function debit($username, $debitamount, $date)
{
    //  echo $username;
    $connectiontry = mysqli_connect("localhost", "root", "", "chadvent");
    if ($username == "") {
    } else {

        $testing = strtolower($username . "_statement");
        $countquery1 = "select count(*) from $testing";
        $result = mysqli_query($connectiontry, $countquery1);
        $array = mysqli_fetch_array($result);
        $finalcount = $array['count(*)'];
        if ($finalcount == 0) {
            $words = "Debit of ₦" . -$debitamount;
            $totalsave = "₦" . -$debitamount;
            $updatelasttransaction = "update userdetails set last_transaction = '$words' where username = '$username'";
            $updatetotalsavings = "update userdetails set total_savings = '$totalsave' where username = '$username'";
            mysqli_query($connectiontry, $updatelasttransaction);
            mysqli_query($connectiontry, $updatetotalsavings);
            $query = "INSERT INTO `$testing`(`date`, `narration`, `debit`, `credit`, `balance`) VALUES ('$date','Account Debited','-$debitamount',0,'-$debitamount')";
            mysqli_query($connectiontry, $query);
        } else {
            $words = "Debit of ₦" . $debitamount;
            $updatelasttransaction = "update userdetails set last_transaction = '$words' where username = '$username'";
            mysqli_query($connectiontry, $updatelasttransaction);

            //count all in database and return last index
            $countquery1 = "select count(*) from $testing";
            $resultofcount = mysqli_query($connectiontry, $countquery1);
            $arrayofcount = mysqli_fetch_array($resultofcount);
            $indexoflast = $arrayofcount['count(*)'] - 1;


            $fulldata = "select * from $testing";
            $execute = mysqli_query($connectiontry, $fulldata);
            $arrayofeverything = mysqli_fetch_all($execute);
            $lasttransaction = $arrayofeverything[$indexoflast];
            $lastbalance = $lasttransaction[5];
            $totalsavings = $lastbalance - $debitamount;
            $totalsave = "₦" . $totalsavings;
            $updatetotalsavings = "update userdetails set total_savings = '$totalsave' where username = '$username'";
            mysqli_query($connectiontry, $updatetotalsavings);
            $secondquery = "INSERT INTO `$testing`(`date`, `narration`, `debit`, `credit`, `balance`) VALUES ('$date','Account Debited','$debitamount',0,'$totalsavings')";
            mysqli_query($connectiontry, $secondquery);
        }
    }
}

function getStatement($username)
{
    $connection = mysqli_connect('localhost', 'root', '', 'chadvent');
    $memberstatement = $username . "_statement";
    $query = "select * from $memberstatement";
    $execute = mysqli_query($connection, $query);
    $fullstatement = mysqli_fetch_all($execute);
    return $fullstatement;
}

function membershipCount()
{
    $connection = mysqli_connect('localhost', 'root', '', 'chadvent');
    $query = "select * from userdetails";
    $executedquery = mysqli_query($connection, $query);
    $array = mysqli_fetch_all($executedquery);
    return count($array);
}

function getnews()
{
    $connection = mysqli_connect('localhost', 'root', '', 'chadvent');
    $query = "select * from latest_news";
    $executedquery = mysqli_query($connection, $query);
    $array = mysqli_fetch_assoc($executedquery);
    return $array;
}

function editNews($news)
{
    $connection = mysqli_connect('localhost', 'root', '', 'chadvent');
    $query = "update latest_news set news='$news' where id=1";
    mysqli_query($connection, $query);
}

function getDetails($username)
{
    $connection = mysqli_connect('localhost', 'root', '', 'chadvent');
    $query = "select * from userdetails where username = '$username'";
    $execute = mysqli_query($connection, $query);
    $array = mysqli_fetch_assoc($execute);
    return $array;
}

function changePicture($username, $picture)
{
    $connection = mysqli_connect('localhost', 'root', '', 'chadvent');
    $imagename = $picture['name'];
    $target = 'resources/images/' . $imagename;
    move_uploaded_file($picture['tmp_name'], $target);
    $extension = explode(".", $target);
    for ($i = 0; $i <= count($extension) - 1; $i++) {
        if ($i = count($extension) - 1) {
            $newimagepath = "resources/images/" . $username . "." . $extension[$i];
            $imagename = $username . "." . $extension[$i];
            rename("$target", "$newimagepath");
            $query = "update userdetails set profile_picture = '$imagename' where username = '$username'";
            mysqli_query($connection, $query);
        }
    }
}

function updatePassword($username, $newpassword)
{
    $connection = mysqli_connect('localhost', 'root', '', 'chadvent');
    $query = "update userdetails set password = '$newpassword' where username = '$username'";
    mysqli_query($connection, $query);
}
