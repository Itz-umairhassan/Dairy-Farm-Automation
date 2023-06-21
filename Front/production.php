<div class="dash-content">

    <div class="title heading">
        <span class='text'>Production History</span>
        <div>
            <input style=" width: 100px; cursor:pointer;"  id="myfile" type="file" class="btn-primary" name="csv">
            <button id="upload" type="button" class="btn btn-primary">Enter new Production </button>
        </div>
    </div>

    
</div>


<script>

    function handle_uploading(event) {
        event.preventDefault();

        console.log("You just clicked");
        let file_data = $("#myfile").prop('files')[0];
        let form_data = new FormData();
        form_data.append("csv", file_data);

        $.ajax({
            url: './production/add',
            dataType: "text",
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: (message) => {
                console.log(JSON.parse(message));
            },
            error: (message) => {
                console.log(message);
            }

        })
    }
    $(document).ready(() => {
       
        $("#upload").on("click", e => handle_uploading(e));
    })
</script>
