
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
      <div class="mini-window" id="miniWindow" style="position: fixed; bottom: 0; right: 0; width: 300px; height: 40px; border: 1px solid #ccc; background: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); transition: height 0.3s ease; z-index: 9999; border-radius:15px 0px 0px 0px">
        <div class="mini-window-header" onclick="toggleMinimize()" style="padding: 10px; background: #6f42c1; color: #fff; cursor: pointer; border-radius:15px 0px 0px 0px">Activity Logs</div>
        <div class="mini-window-content" id="miniWindowContent" style="padding: 10px; overflow-y: auto; height: calc(100% - 40px);">
        </div>
      </div>
     
    </div>
        <script>
          function toggleMinimize() {
    const miniWindow = document.getElementById('miniWindow');
    if (miniWindow.style.height === '40px') {
      miniWindow.style.height = '500px';
    } else {
      miniWindow.style.height = '40px';
    }
  }

  let prev_activity_logs = [];

  function areLogsDifferent(logs1, logs2) {
    if (logs1.length !== logs2.length) {
      return true;
    }
    for (let i = 0; i < logs1.length; i++) {
      if (JSON.stringify(logs1[i]) !== JSON.stringify(logs2[i])) {
        return true;
      }
    }
    return false;
  }


  function displayContent(activity_logs) {
    if (areLogsDifferent(activity_logs, prev_activity_logs)) {
    console.log('activity_logs:', activity_logs)
    prev_activity_logs = JSON.parse(JSON.stringify(activity_logs));
    const miniWindowContent = document.getElementById('miniWindowContent');
    if (activity_logs?.length > 0){
      miniWindowContent.innerHTML = '';  // Clear the existing content
    }
    activity_logs.forEach((log, index) => {
      const logLink = document.createElement('a');
      logLink.href = `{{url('documents/upload/${1}')}}`;
      logLink.style.display = 'block';
      logLink.style.padding = '15px 20px';
      logLink.style.color = '#000';
      logLink.style.backgroundColor = index % 2 === 0 ? '#f9f9f9' : '#e9e9e9';
      logLink.textContent = log.content;
      miniWindowContent.appendChild(logLink);
      const miniWindow = document.getElementById('miniWindow');
        if (miniWindow.style.height === '40px'){
          if (activity_logs.length < 4 ){
          miniWindow.style.height = '200px';
        }else {
          miniWindow.style.height = '500px';
        }
        }
    });
  }
  }

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
                          //console.log(data.current_user_records);
                          displayContent(data.current_user_records);
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