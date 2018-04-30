<?php 
use Slim\Http\Request;
use Slim\Http\Response;

// Get All dkhn
$app->get('/api/dkhn', function(Request $request, Response $response){
    $sql = "SELECT * FROM dkhn"; 
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

// Get Single Customer
$app->get('/api/dkhn/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM dkhn WHERE stt = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $dkhn = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($dkhn);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Add dkhn
$app->post('/api/dkhn/add', function(Request $request, Response $response){         
    $hoVaTen = $request->getParam('hoVaTen');
    $lop = $request->getParam('lop');
    $truong = $request->getParam('truong');
    $diaChi = $request->getParam('diaChi');
    $sdt = $request->getParam('sdt');
    $hocLuc = $request->getParam('hocLuc');
    $lyDo = $request->getParam('lyDo'); 
    $maDangKy = $request->getParam('maDangKy');
    $ngayDangKy = $request->getParam('ngayDangKy');
    $ngayNhapHoc = $request->getParam('ngayNhapHoc'); 

    $sql = "INSERT INTO dkhn (hoVaTen, lop, truong, diaChi, sdt, hocLuc,
    lyDo, maDangKy, ngayDangKy, ngayNhapHoc) VALUES
    (:hoVaTen, :lop, :truong, :diaChi, :sdt, :hocLuc,
    :lyDo, :maDangKy, :ngayDangKy, :ngayNhapHoc)"; 

    $sqlQlhv = "INSERT INTO qlhv (maDangKy) VALUES (:maDangKy)";

    // echo $sql."<br>".$hoVaTen."<br>";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);        
        
        $stmt->bindParam(':hoVaTen', $hoVaTen);
        $stmt->bindParam(':lop',  $lop);
        $stmt->bindParam(':truong',$truong);
        $stmt->bindParam(':diaChi',      $diaChi);
        $stmt->bindParam(':sdt',    $sdt);
        $stmt->bindParam(':hocLuc',       $hocLuc);
        $stmt->bindParam(':lyDo',      $lyDo); 
        $stmt->bindParam(':maDangKy',      $maDangKy);
        $stmt->bindParam(':ngayDangKy',       $ngayDangKy);
        $stmt->bindParam(':ngayNhapHoc',      $ngayNhapHoc);        

        $stmt->execute();

        //quan ly hoc vien
        $stmtQlhv = $db->prepare($sqlQlhv);
        $stmtQlhv->bindParam(':maDangKy',      $maDangKy);
        $stmtQlhv->execute();

        echo '{"notice": {"ActionStatus": "1"}';

    } catch(PDOException $e){
        echo '{"error": {"ActionStatus": '.$e->getMessage().'}';
    }
});

// Update dkhn
$app->post('/api/dkhn/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $hoVaTen = $request->getParam('hoVaTen');
    $lop = $request->getParam('lop');
    $truong = $request->getParam('truong');
    $diaChi = $request->getParam('diaChi');
    $sdt = $request->getParam('sdt');
    $hocLuc = $request->getParam('hocLuc');
    $lyDo = $request->getParam('lyDo'); 
    $maDangKy = $request->getParam('maDangKy');
    $ngayDangKy = $request->getParam('ngayDangKy');
    $ngayNhapHoc = $request->getParam('ngayNhapHoc'); 

    $sql = "UPDATE dkhn SET
				hoVaTen 	= :hoVaTen,
				lop 	= :lop,
                truong		= :truong,
                diaChi		= :diaChi,
                sdt 	= :sdt,
                hocLuc 		= :hocLuc,
                lyDo 		= :lyDo,
                maDangKy		= :maDangKy,
                ngayDangKy		= :ngayDangKy,
                ngayNhapHoc		= :ngayNhapHoc 
            WHERE stt = $id";
            
    $sqlQlhv = "UPDATE qlhv SET 
                    maDangKy		= :maDangKy

            WHERE stt = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':hoVaTen', $hoVaTen);
        $stmt->bindParam(':lop',  $lop);
        $stmt->bindParam(':truong',$truong);
        $stmt->bindParam(':diaChi',      $diaChi);
        $stmt->bindParam(':sdt',    $sdt);
        $stmt->bindParam(':hocLuc',       $hocLuc);
        $stmt->bindParam(':lyDo',      $lyDo); 
        $stmt->bindParam(':maDangKy',      $maDangKy);
        $stmt->bindParam(':ngayDangKy',       $ngayDangKy);
        $stmt->bindParam(':ngayNhapHoc',      $ngayNhapHoc); 

        $stmt->execute();

        //Quản lý học viên
        $stmtQlhv = $db->prepare($sqlQlhv); 
        $stmtQlhv->bindParam(':maDangKy',      $maDangKy);
        $stmtQlhv->execute();

        echo '{"notice": {"ActionStatus": 1}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete dkhn
$app->post('/api/dkhn/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id'); 
    $sql = "DELETE FROM dkhn WHERE stt = $id";
    $sqlQlhv = "DELETE FROM qlhv WHERE stt = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();

        //quản lý học viên
        $stmtQlhv = $db->prepare($sqlQlhv);
        $stmtQlhv->execute();

        $db = null;
        echo '{"notice": {"ActionStatus": 1}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});