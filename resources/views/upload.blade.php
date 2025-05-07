<!DOCTYPE html>
<html>
<head><title>Upload</title></head>
<body>
    <h3>Upload File CSV/Excel</h3>
    @if(session('success')) <p style="color:green">{{ session('success') }}</p> @endif
    <form method="POST" action="/upload" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
