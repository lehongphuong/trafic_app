<?php 
use Slim\Http\Request;
use Slim\Http\Response; 


// Get All qlhv
$app->get('/api/qlhv', function(Request $request, Response $response){
    $sql = "SELECT a.hoVaTen, a.diaChi, b.* FROM dkhn a inner join qlhv b
        on a.stt = b.stt
    "; 
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect(); 

        $stmt = $db->query($sql);
        $dkhn = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($dkhn);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// // Get Single Customer
// $app->get('/api/dkhn/{id}', function(Request $request, Response $response){
//     $id = $request->getAttribute('id');

//     $sql = "SELECT * FROM dkhn WHERE stt = $id";

//     try{
//         // Get DB Object
//         $db = new db();
//         // Connect
//         $db = $db->connect();

//         $stmt = $db->query($sql);
//         $dkhn = $stmt->fetch(PDO::FETCH_OBJ);
//         $db = null;
//         echo json_encode($dkhn);
//     } catch(PDOException $e){
//         echo '{"error": {"text": '.$e->getMessage().'}';
//     }
// });

// // Add dkhn
// $app->post('/api/dkhn/add', function(Request $request, Response $response){         
//     $hoVaTen = $request->getParam('hoVaTen');
//     $lop = $request->getParam('lop');
//     $truong = $request->getParam('truong');
//     $diaChi = $request->getParam('diaChi');
//     $sdt = $request->getParam('sdt');
//     $hocLuc = $request->getParam('hocLuc');
//     $lyDo = $request->getParam('lyDo');
//     $monDangKy = $request->getParam('monDangKy');
//     $maDangKy = $request->getParam('maDangKy');
//     $ngayDangKy = $request->getParam('ngayDangKy');
//     $ngayNhapHoc = $request->getParam('ngayNhapHoc'); 

//     $sql = "INSERT INTO dkhn (hoVaTen, lop, truong, diaChi, sdt, hocLuc,
//     lyDo, monDangKy, maDangKy, ngayDangKy, ngayNhapHoc) VALUES
//     (:hoVaTen, :lop, :truong, :diaChi, :sdt, :hocLuc,
//     :lyDo, :monDangKy, :maDangKy, :ngayDangKy, :ngayNhapHoc)"; 

//     // echo $sql."<br>".$hoVaTen."<br>";
//     try{
//         // Get DB Object
//         $db = new db();
//         // Connect
//         $db = $db->connect();

//         $stmt = $db->prepare($sql);

//         $stmt->bindParam(':hoVaTen', $hoVaTen);
//         $stmt->bindParam(':lop',  $lop);
//         $stmt->bindParam(':truong',$truong);
//         $stmt->bindParam(':diaChi',      $diaChi);
//         $stmt->bindParam(':sdt',    $sdt);
//         $stmt->bindParam(':hocLuc',       $hocLuc);
//         $stmt->bindParam(':lyDo',      $lyDo);
//         $stmt->bindParam(':monDangKy',       $monDangKy);
//         $stmt->bindParam(':maDangKy',      $maDangKy);
//         $stmt->bindParam(':ngayDangKy',       $ngayDangKy);
//         $stmt->bindParam(':ngayNhapHoc',      $ngayNhapHoc);        

//         $stmt->execute();

//         echo '{"notice": {"ActionStatus": "1"}';

//     } catch(PDOException $e){
//         echo '{"error": {"ActionStatus": '.$e->getMessage().'}';
//     }
// });

// Update qlhv
$app->post('/api/qlhv/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id'); 
    $hoVaTen = $request->getParam('hoVaTen');
    $diaChi = $request->getParam('diaChi');
    $maDangKy = $request->getParam('maDangKy');
    $quanHe = $request->getParam('quanHe');
    $ngayNhapHoc = $request->getParam('ngayNhapHoc');
    $nghiLe = $request->getParam('nghiLe');
    $ngayKetThuc = $request->getParam('ngayKetThuc');
    $nghiCoPhep = $request->getParam('nghiCoPhep');
    $ngayChuKy = $request->getParam('ngayChuKy');
    $ngayHoc = $request->getParam('ngayHoc');
    $hpChuan = $request->getParam('hpChuan');  
    $tangHpDieuChinh = $request->getParam('tangHpDieuChinh'); 
    $giamHp = $request->getParam('giamHp'); 
    $hptt = $request->getParam('hptt'); 
    $phieuThu = $request->getParam('phieuThu'); 
    $daDong = $request->getParam('daDong'); 
    $conLai = $request->getParam('conLai'); 

    $sql = "UPDATE qlhv SET 
                maDangKy= :maDangKy,
                quanHe = :quanHe ,
                ngayNhapHoc= :ngayNhapHoc,
                nghiLe = :nghiLe ,
                ngayKetThuc= :ngayKetThuc,
                nghiCoPhep = :nghiCoPhep ,
                ngayChuKy  = :ngayChuKy  ,
                ngayHoc= :ngayHoc,
                hpChuan= :hpChuan,
                tangHpDieuChinh= :tangHpDieuChinh,
                giamHp = :giamHp ,
                hptt   = :hptt   ,
                phieuThu= :phieuThu,
                daDong = :daDong ,
                conLai = :conLai 
            WHERE stt = $id";
            
    $sqlDkhn = "UPDATE dkhn SET
            hoVaTen= :hoVaTen,
            diaChi = :diaChi ,
            maDangKy= :maDangKy
            WHERE stt = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql); 

        $stmt->bindParam(':maDangKy', $maDangKy);
        $stmt->bindParam(':quanHe',  $quanHe);
        $stmt->bindParam(':ngayNhapHoc',$ngayNhapHoc);
        $stmt->bindParam(':nghiLe',      $nghiLe);
        $stmt->bindParam(':ngayKetThuc',    $ngayKetThuc);
        $stmt->bindParam(':nghiCoPhep',       $nghiCoPhep);
        $stmt->bindParam(':ngayChuKy',      $ngayChuKy);
        $stmt->bindParam(':ngayHoc',       $ngayHoc);
        $stmt->bindParam(':hpChuan',      $hpChuan);
        $stmt->bindParam(':tangHpDieuChinh',       $tangHpDieuChinh);
        $stmt->bindParam(':giamHp',      $giamHp); 
        $stmt->bindParam(':hptt',      $hptt); 
        $stmt->bindParam(':phieuThu',      $phieuThu); 
        $stmt->bindParam(':daDong',      $daDong); 
        $stmt->bindParam(':conLai',      $conLai);  

        $stmt->execute();

        //update Đăng ký hàng ngày
        $stmtDkhn = $db->prepare($sqlDkhn);  
        $stmtDkhn->bindParam(':hoVaTen',      $hoVaTen); 
        $stmtDkhn->bindParam(':diaChi',      $diaChi); 
        $stmtDkhn->bindParam(':maDangKy', $maDangKy);

        $stmtDkhn->execute();

        echo '{"notice": {"ActionStatus": 1}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// // Delete dkhn
// $app->post('/api/dkhn/delete/{id}', function(Request $request, Response $response){
//     $id = $request->getAttribute('id'); 
//     $sql = "DELETE FROM dkhn WHERE stt = $id";

//     try{
//         // Get DB Object
//         $db = new db();
//         // Connect
//         $db = $db->connect();

//         $stmt = $db->prepare($sql);
//         $stmt->execute();
//         $db = null;
//         echo '{"notice": {"ActionStatus": 1}';
//     } catch(PDOException $e){
//         echo '{"error": {"text": '.$e->getMessage().'}';
//     }
// });