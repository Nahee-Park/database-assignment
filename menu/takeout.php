
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
    $query = "SELECT DISTINCT MENU.MENU_NAME AS 메뉴이름, ORDER_LIST.IS_TAKEOUT AS 포장여부, COUNT(ORDER_LIST.ORDER_NUM ) AS 주문건수
    FROM MENU, ORDER_LIST, MENU_ORDER
    WHERE ORDER_LIST.ORDER_NUM = MENU_ORDER.ORDER_NUM AND
    MENU_ORDER.MENU_ID = MENU.MENU_ID
    GROUP BY MENU.MENU_NAME,ORDER_LIST.IS_TAKEOUT WITH ROLLUP;";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>메뉴별 테이크아웃 건수</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>메뉴이름</TD>
            <TD>포장여부</TD>
            <td>주문건수</td>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['메뉴이름']?></TD>
                <TD><?=$row['포장여부']?></TD>
                <TD><?=$row['주문건수']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<!-- <p>*주문빈도 기준 내림차순 정렬</p> -->
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

