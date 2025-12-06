<?php
session_start();

// 1. Inisialisasi Data
if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = [
        ["id" => 1, "title" => "Belajar PHP", "status" => "belum"],
        ["id" => 2, "title" => "Kerjakan tugas UX", "status" => "selesai"]
    ];
}

// 2. Tambah Tugas
if (isset($_POST['tambah'])) {
    $judul = trim($_POST['judul']);
    if ($judul !== '') {
        // Pastikan session array ada
        if (!isset($_SESSION['tasks'])) {
            $_SESSION['tasks'] = [];
        }

        // Cari ID tertinggi yang sudah ada
        $maxId = 0;
        foreach ($_SESSION['tasks'] as $task) {
            if (isset($task['id']) && $task['id'] > $maxId) {
                $maxId = $task['id'];
            }
        }

        // Tambahkan tugas baru dengan ID unik
        $_SESSION['tasks'][] = [
            "id" => $maxId + 1,
            "title" => $judul,
            "status" => "belum"
        ];
    }
    header("Location: index.php");
    exit;
}


// 3. Update Tugas
if (isset($_POST['ubah'])) {
    $ubahId = (int) $_POST['ubah'];

    foreach ($_SESSION['tasks'] as $key => $task) {
        if (is_array($task) && isset($task['id']) && $task['id'] === $ubahId) {
            $_SESSION['tasks'][$key]['status'] = $task['status'] === 'belum' ? 'selesai' : 'belum';
            break;
        }
    }

    header("Location: index.php");
    exit;
}

    // 4. Hapus Tugas
if (isset($_GET['hapus'])) {
    $hapusId = (int) $_GET['hapus'];

    foreach ($_SESSION['tasks'] as $key => $task) {
        if (is_array($task) && isset($task['id']) && $task['id'] === $hapusId) {
            unset($_SESSION['tasks'][$key]);
            break;
        }
    }

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi To-Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Load Css -->
    <link rel="stylesheet" href="style.css">
    <!-- Load Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h1 class="text-center mb-4">Aplikasi To-Do List</h1>

    <!-- Form Tambah Tugas -->
    <form method="POST" class="mb-4">
        <div class="input-group">
            <input type="text" name="judul" class="form-control" placeholder="Tambah tugas baru..." required>
            <button class="btn btn-primary" name="tambah">Tambah</button>
        </div>
    </form>

    <!-- Tabel Daftar Tugas -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Judul Tugas</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['tasks'] as $task): ?>
            <?php if (is_array($task) && isset($task['id'], $task['title'], $task['status'])): ?>
                <tr>
                    <td><?= $task['id'] ?></td>
                    <td><?= htmlspecialchars($task['title']) ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="ubah" value="<?= $task['id']; ?>">
                            <input type="checkbox" onchange="this.form.submit()" 
                                <?= $task['status'] === 'selesai' ? 'checked' : '' ?>>
                        </form>
                        <span class="ms-2"><?= ucfirst($task['status']); ?></span>
                    </td>
                    <td class="text-center">
                        <a href="?hapus=<?= $task['id']; ?>" 
                           onclick="return confirm('Yakin ingin menghapus tugas ini?')" 
                           class="btn btn-sm btn-danger">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
