
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer - 나이대별 주문건수</title>
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
    $query = "SELECT (CASE WHEN (CU.AGE>= 10 AND CU.AGE<= 19) THEN '10대'
    WHEN (CU.AGE>= 20 AND CU.AGE<= 29) THEN '20대'
    WHEN (CU.AGE>= 30 AND CU.AGE<= 39) THEN '30대'
    WHEN (CU.AGE>= 40 AND CU.AGE<= 49) THEN '40대'
    WHEN (CU.AGE>= 50 AND CU.AGE<= 59) THEN '50대'
    WHEN (CU.AGE>= 60 AND CU.AGE<= 69) THEN '60대'
    ELSE '기타'
    END) AS '연령대', CO.CORNER_NAME as '코너이름', COUNT(CO.CORNER_NAME) as '주문빈도'
    FROM ORDER_LIST OL
    INNER JOIN CUSTOMER CU
    ON CU.PHONENUMBER = OL.CUSTOMER_PHONENUMBER
    INNER JOIN CORNER CO
    ON OL.COR_ID = CO.CORNER_ID
    GROUP BY 연령대, 코너이름
    ORDER BY 연령대 ASC, 주문빈도 DESC;
    ";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>나이대별 코너별 주문건수</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>연령대</TD>
            <TD>코너 이름</TD>
            <td>주문빈도</td>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['연령대']?></TD>
                <TD><?=$row['코너이름']?></TD>
                <TD><?=$row['주문빈도']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<p>*주문빈도 기준 내림차순 정렬</p>
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

