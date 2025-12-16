<!DOCTYPE html>
<html>
<head>
  <title>Create Form</title>
  <link rel="stylesheet" href="assets/style.css">
  <script src="assets/script.js"></script>
</head>
<body>

<div class="container">
  <h2>Create Form</h2>

  <form action="save_form.php" method="post">
    <input type="text" name="title" placeholder="Form Title" required>

    <div class="builder-controls">
      <button type="button" onclick="addField()">➕ Add Field</button>
    </div>

    <div id="fieldsContainer"></div>

    <button type="submit">Save Form</button>
  </form>
</div>

</body>
</html>
