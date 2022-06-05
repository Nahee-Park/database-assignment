
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
    $query = "select co.corner_name as 코너이름, m.menu_name as 메뉴, count(co.corner_name) as 주문빈도 ,
    case when cu.is_ewhain = 'TRUE' then '이대학생 O'
        when cu.is_ewhain = 'FALSE' then '이대학생 X'
        else '기타'
        end as 이대학생여부
from ORDER_LIST ol
inner join CUSTOMER cu
on cu.phonenumber = ol.customer_phonenumber
inner join MENU_ORDER mo
on ol.order_num = mo.order_num
inner join MENU m
on mo.menu_id =m.menu_id
inner join CORNER co
on ol.cor_id = co.corner_id
group by cu.is_ewhain, co.corner_name,m.menu_name
order by co.corner_name, m.menu_name, cu.is_ewhain desc;";
    $result = mysqli_query($conn,$query);
    ?>
    
    <FORM>
    <h1>이대 학생/ 타대 학생 코너별 비율</h1>

    <TABLE BORDER=1>
        <TR>
            <TD>코너이름</TD>
            <TD>메뉴</TD>
            <TD>주문빈도</TD>
            <TD>이대학생여부</TD>
        </TR>
        <?php 
        while($row = mysqli_fetch_array($result)){
            ?>
            <TR>
                <TD><?=$row['코너이름']?></TD>
                <TD><?=$row['메뉴']?></TD>
                <TD><?=$row['주문빈도']?></TD>
                <TD><?=$row['이대학생여부']?></TD>
            </TR>
            <?php } ?>
        
        
</TABLE>
<p>*코너이름, 메뉴 오름차순 정렬 / 이대학생여부 내림차순 정렬</p>
    </FORM>
    <?php 
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
</body>
</html>

