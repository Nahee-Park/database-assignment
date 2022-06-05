
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
    $query = "SELECT  CO.CORNER_NAME AS 코너이름
    ,case when CU.SEX = 'FEMALE' then '여자'
    when CU.SEX = 'MALE' then '남자'
    else '기타'
    end as 성별  , COUNT(CO.CORNER_NAME) AS 주문건수
FROM ORDER_LIST OL
JOIN CUSTOMER CU
ON CU.PHONENUMBER = OL.CUSTOMER_PHONENUMBER
JOIN MENU_ORDER MO
ON OL.ORDER_NUM = MO.ORDER_NUM
JOIN MENU M
ON MO.MENU_ID = M.MENU_ID
JOIN CORNER CO
ON M.C_ID = CO.CORNER_ID
GROUP BY  CU.SEX, CO.CORNER_NAME
ORDER BY  CO.CORNER_NAME;
    ";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>성별에 따른 코너별 주문건수</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>코너이름</TD>
            <TD>성별</TD>
            <td>주문건수</td>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['코너이름']?></TD>
                <TD><?=$row['성별']?></TD>
                <TD><?=$row['주문건수']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<p>*코너이름 기준 오름차순 정렬</p>
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

