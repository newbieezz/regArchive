
<header>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</header>
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
      <div class="mb-2 mb-md-0">
        ©
        <script>
          document.write(new Date().getFullYear());
        </script>
        , made with ❤️ by
        <a href="javascript:;" target="_blank" class="footer-link fw-medium">Rocketship</a>
      </div>
      <!--
      <div class="d-none d-lg-inline-block">
        <a href="" class="footer-link me-4" target="_blank">License</a>
        <a href="" target="_blank" class="footer-link me-4">More Themes</a>

        <a
          href=""
          target="_blank"
          class="footer-link me-4"
          >Documentation</a
        >

        <a
          href=""
          target="_blank"
          class="footer-link"
          >Support</a
        > 
      </div>
      -->
     
    </div>
        <script>
            $(document).ready(function() {
                let lastEntryId = null;
      
                function checkForNewEntry() {
                  $.ajax({
                    url: '/storeActivityLog',
                    type: 'POST',
                    data: {},
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        //console.log('STORE...', data);
                        if (data.message == 'Already Informed'){
                          //console.log(data.message);
                        }
                        else if (data.message == 'Entry already exists'){
                          //console.log(data.message);
                        }
                        else if (data.latestEntry.id){
                          alert(data.latestEntry.content);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    }
                });
                }
                
      
                setInterval(checkForNewEntry, 5000); // Check every 5 seconds
            });
        </script>
  </footer>