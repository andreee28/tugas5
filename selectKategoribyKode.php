<?php
include 'koneksi.php';

$conn = getConnection();

$id = isset($_GET['id']) ? $_GET['id'] : '';

try {
    $query = "SELECT * FROM kategori WHERE id = :id";
    
      $statement = $conn->prepare($query);
    
    $statement->bindParam(':id', $id);
    
    $statement->execute();
    
    $kategori = $statement->fetch(PDO::FETCH_ASSOC);
    
     if ($kategori) {
        $response = [
            'status' => 'success',
            'data' => $kategori
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Data kategori tidak ditemukan'
        ];
    }
} catch(PDOException $e) {
       $response = [
        'status' => 'error',
        'message' => 'Terjadi kesalahan saat memilih data kategori: ' . $e->getMessage()
    ];
}

echo json_encode($response);

$conn = null;
?>