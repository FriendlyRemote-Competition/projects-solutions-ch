<?php
$data = json_decode(file_get_contents('./table.json'));
$i = 0;
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>C3</title>
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css" />
</head>
<body>
  <form class="container py-5" action="" method="POST">
    <div
      class="table-responsive"
    >
      <table
        class="table table-striped"
      >
        <thead>
          <tr class="table-dark">
            <?php foreach($data[0] as $key => $value) { ?>
              <th scope="col">
                <input type="text" value="<?= $key ?>" class="form-control" name="keys[<?= $i ?>]" />
              </th>
            <?php $i++; } ?>
            <th>== Delete ==</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data as $i => $row) { $j = 0; ?>
            <tr data-row="<?= $i ?>">
              <?php foreach($row as $value) { ?>
                <td>
                  <input type="text" value="<?= $value ?>" class="form-control" name="rows[<?= $i ?>][<?= $j ?>]" />
                </td>
              <?php $j++; } ?>
              <td>
                <button class="btn btn-danger" type="button" data-row="<?= $i ?>">Delete</button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-end gap-2">
      <button class="btn btn-secondary" type="button" id="addRow">Add row</button>
      <button class="btn btn-primary" type="submit">Save</button>
    </div>
  </form>
  <script>
    const tbody = document.querySelector("tbody");
    tbody.querySelectorAll("button").forEach(btn => {
      btn.addEventListener("click", (e) => {
        const rows = Array.from(tbody.rows)
        tbody.innerHTML = "";
        tbody.append(...rows.filter((row) => row.dataset.row != btn.dataset.row));
      });
    });

    document.getElementById("addRow").addEventListener("click", () => {
      const row = parseInt(tbody.rows[tbody.rows.length - 1].dataset.row) + 1;
      const tr = document.createElement("tr");
      tr.dataset.row = row;
      for (let i = 0; i < 5; i++) {
        const td = document.createElement("td");
        td.innerHTML = `<input type="text" value="" class="form-control" name="rows[${row}][${i}]" />`
        tr.appendChild(td);
      }
      const td = document.createElement("td");
      const btn = document.createElement("button");
      btn.classList.add("btn", "btn-danger");
      btn.type = "button";
      btn.dataset.row = row;
      btn.innerText = "Delete";
      btn.addEventListener("click", (e) => {
          const rows = Array.from(tbody.rows)
          tbody.innerHTML = "";
          tbody.append(...rows.filter((row) => row.dataset.row != btn.dataset.row));
        });
      td.appendChild(btn)
      tr.appendChild(td);
      tbody.append(tr);
    })

  </script>
</body>
</html>