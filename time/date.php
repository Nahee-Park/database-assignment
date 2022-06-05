
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TIME - DATE</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <?php 
    $conn = mysqli_connect("localhost","web","web_admin","food_court");
    if(!$conn){
        echo "Database Connection Error!";
    }
    if(mysqli_connect_errno()){
        echo "Could not connect: " . mysqli_connect_error();
        exit();
    }
    $query = "SELECT DATE_FORMAT(OL.ORDER_DATETIME, '%Y-%m-%d') AS 날짜 , CO.CORNER_NAME AS 코너이름
    , COUNT(CO.CORNER_NAME) AS 주문건수 
    FROM ORDER_LIST OL JOIN CUSTOMER AS CU
ON CU.PHONENUMBER = OL.CUSTOMER_PHONENUMBER
JOIN MENU_ORDER MO 
ON OL.ORDER_NUM = MO.ORDER_NUM
JOIN MENU M 
ON MO.MENU_ID = M.MENU_ID
JOIN CORNER CO 
ON M.C_ID = CO.CORNER_ID
GROUP BY DATE_FORMAT(OL.ORDER_DATETIME, '%d'), CO.CORNER_NAME
ORDER BY DATE_FORMAT(OL.ORDER_DATETIME, '%d'), CO.CORNER_NAME";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>날짜에 따른 코너별 주문 건수</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>날짜</TD>
            <TD>코너 이름</TD>
            <td>주문 건수</td>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['날짜']?></TD>
                <TD><?=$row['코너이름']?></TD>
                <TD><?=$row['주문건수']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

