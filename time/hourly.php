
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIME - HOURLY</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php 
    $conn = mysqli_connect("localhost","web","web_admin","ewha_food");
    if(!$conn){
        echo "Database Connection Error!";
    }
    if(mysqli_connect_errno()){
        echo "Could not connect: " . mysqli_connect_error();
        exit();
    }
    $query = "SELECT DATE_FORMAT(ORDER_DATETIME, '%H') AS 시간, COUNT(ORDER_NUM) AS 횟수 
    FROM ORDER_LIST
    GROUP BY DATE_FORMAT(ORDER_DATETIME, '%H')
    ORDER BY DATE_FORMAT(ORDER_DATETIME, '%H')";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>시간대별 주문 건수</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>시간</TD>
            <TD>주문 건수</TD>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['시간']?></TD>
                <TD><?=$row['횟수']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<p>*푸드코트 운영 시간 : 오전 10시 ~ 오후 11시</p>
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

