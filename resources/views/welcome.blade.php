<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5">
    
    <div class="card">
        <div class="card-body">
            
            <h2>Books</h2>
            <button class="btn btn-sm btn-success float-end" data-bs-toggle="modal" id="btn-add">Add Book</button>  
            
            <div class="mt-5">
            
                <table class="table table-border table-responsive table-hover" id="table-book">
                <thead>
                    <tr>
                    <th>TITLE</th>
                    <th>ISBN</th>
                    <th>AUTHOR</th>
                    <th>PUBLISHER</th>
                    <th>YEAR PUBLISHED</th>
                    <th>CATEGORY</th>
                    <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->year_published }}</td>
                        <td>{{ $book->category }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteBook('{{$book->id}}')">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                </table>
            </div>
        </div>
    </div> 

<!-- Modal -->
<div class="modal fade" id="manageBook" tabindex="-1" aria-labelledby="manageBookLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="manageBookLabel"> Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-manage" enctype="multipart/form-data">
                <input type="text" id="type" hidden value="add">
                <input type="text" id="id" hidden name="id" >
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" required name="title">
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" required name="isbn">
                  </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" id="author" required name="author">
                </div>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" class="form-control" id="publisher" required name="publisher">
                  </div>

                  <div class="mb-3">
                    <label for="year_published" class="form-label">Year Published</label>
                    <input type="number" class="form-control" id="year_published" required name="year_published">
                  </div>
                  <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" required name="category">
                  </div>
                <button type="submit" class="btn btn-primary" id="manageBookButton">Add</button>
            </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="deleteBook" tabindex="-1" aria-labelledby="deleteBookLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteBookLabel">Delete Book</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="form-delete" class="text-center">
                <input type="text" name="" id="book_id" hidden>
                <h4 class="text-center">Are you sure want to delete this book?</h4>

               <button type="submit" class="btn btn-danger">Yes</button>
               <a class="btn btn-primary" data-bs-dismiss="modal" >Cancel</a>
            </form>
        </div>
      </div>
    </div>
  </div>

</body>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js" defer></script>
<script>
    var table_book;
    $(function() {
        table_book = $('#table-book').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/getBooks',
            dom: "<'row'<'col-sm-12 col-md-6'<'pull-left'l>><'col-sm-12 col-md-6'<'pull-right'f>>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'<'pull-right'p>>>",
            columns: [
                
                { data: 'title', name: 'title' },
                { data: 'isbn', name: 'isbn' },
                { data: 'author', name: 'author' },
                { data: 'publisher', name: 'publisher' },
                { data: 'year_published', name: 'year_published' },
                { data: 'category', name: 'category' },
                {   
                    "data":"id",
                    "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'left');
                        $(nTd).css('width', '15%');
                    },
                    "mRender": function( data, type, full ,meta) {
                        return `<button class="btn btn-sm btn-primary" onclick="editBook('${full.id}')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteBook('${full.id}')">Delete</button>`;
                    }
                },
            ]
        });
    });

    document.querySelector('#form-manage').addEventListener('submit', (e) => {
        e.preventDefault();
        
        var type = $("#type").val();

        const id = $("#id").val();

        let url;
        let methodUp;
        let formData = {
                id : $("#id").val(),
                title : $("#title").val(),
                isbn : $("#isbn").val(),
                author : $("#author").val(),
                publisher : $("#publisher").val(),
                year_published : $("#year_published").val(),
                category : $("#category").val(),
            };

        if (type === 'add') {
            url = "{{ route('books.store') }}"
            methodUp = 'POST';
            
        } else {
            url = `books/${id}`;
            methodUp = 'PATCH';
            
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: url,
            data: formData,
            cache: false,
            type: methodUp,
            success: function (response) {
                $("#form-manage").trigger('reset');
                table_book.ajax.reload( null, false);
                $('#manageBook').modal('toggle');
                console.log('success')
            }
        });
    });


    document.querySelector('#btn-add').addEventListener('click', (e) => {
        $("#form-manage").trigger('reset');
        $('#manageBook').modal('toggle');
        $('#type').val('add');
        $('#manageBookLabel').text('Add Book');
        $('#manageBookButton').text('Add Book');
    });

    function deleteBook(id)
    {
        $('#deleteBook').modal('toggle');
        $('#book_id').val(id);
    }
    function editBook(id)
    {
        getDataBook(id);
    }

    function getDataBook(id)
    {
        $.ajax({
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "/getDataBook/"+id,
            success: function(data) {
                console.log(data.id);
                
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#isbn').val(data.isbn);
                $('#author').val(data.author);
                $('#publisher').val(data.publisher);
                $('#year_published').val(data.year_published);
                $('#category').val(data.category);

                $('#type').val('edit');
                $('#manageBook').modal('toggle');
                $('#manageBookLabel').text('Edit Book');
                $('#manageBookButton').text('Save Book');
            }
        })
    }

    document.querySelector('#form-delete').addEventListener('submit', (e) => {
        e.preventDefault();
        var book_id = $('#book_id').val();
        var formData = new FormData(e.target);
        fetch("books/"+book_id, { 
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            method: 'DELETE',
        }).then(() => {
            $(this).empty();
            table_book.ajax.reload( null, false);
            $('#deleteBook').modal('toggle');
        });
    });

</script>
</html>
