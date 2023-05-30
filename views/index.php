<!doctype html>
<html lang="EN">
    <?php include '../app/utils/header.php'; ?>
    <style>
        <?php include '../app/styles/styles.css' ?>
    </style>
    <body>
    <header>
        <div class='header-image-wrapper'></div>
        <button id="btn-report" title="click for report">Report</button>
        <script>
            const btn = document.getElementById('btn-report');
            btn.addEventListener('click', () => { document.location.href = '/transactions'; });
        </script>
    </header>

    <br /><hr />

    <h3>Upload your transaction file here to save to the database.</h3><br />

    <form method='POST' enctype='multipart/form-data' action='/' >

        <label>📂 Select the .csv file you want to upload:</label>
        <input type="file" id="user_upload" name="user_upload" />

        <button type='submit'>upload</button>

    </form>

    <br /><hr /><br />



    </body>

</html>
