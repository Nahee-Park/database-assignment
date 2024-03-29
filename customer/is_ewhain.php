
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CORNER - 이대 학생/ 타대 학생 코너별 비율</title>
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
    $query = "
    SELECT CUSTOMER.IS_EWHAIN AS 이대학생여부, COUNT(ORDER_LIST.ORDER_NUM) AS 주문건수
    FROM CUSTOMER , ORDER_LIST
    WHERE CUSTOMER.PHONENUMBER = ORDER_LIST.CUSTOMER_PHONENUMBER
    GROUP BY CUSTOMER.IS_EWHAIN WITH ROLLUP;
    ";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>이대 학생/ 타대 학생 주문 건수</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>이대학생여부</TD>
            <TD>주문건수</TD>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['이대학생여부']?></TD>
                <TD><?=$row['주문건수']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<p>*주문건수 기준 내림차순 정렬</p>
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

