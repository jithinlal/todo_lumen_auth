<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="/materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body>

      <nav>
        <div class="nav-wrapper">
          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="/admin/logout">Logout</a></li>
          </ul>
        </div>
      </nav>

      <div class="container">
          <div class="row">
              <div class="col s6">
                  <table class="centered highlight responsive-table">
                    <tbody>
                        @foreach ($days as $day)
                            <tr>
                              <td>{{ $day->day }}</td>
                              @if($day->start_time == $day->end_time)
                                  <td>Closed</td>
                              @else
                                  <td>{{ \Carbon\Carbon::parse($day->start_time)->format('g:i A') }} to {{ \Carbon\Carbon::parse($day->end_time)->format('g:i A') }}</td>
                              @endif
                              <td><a class="waves-effect waves-light btn editBut"><i class="material-icons left">edit</i>Edit</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
              </div>
          </div>
      </div>

      <div id="modal1" class="modal modal-sm">
        <div class="modal-content">
          <h4>Edit Time</h4>
          <div class="row">
              <div class="col s6">
                  <input type="time" id="start"><label for="">Start Time</label>
                  <input type="time" id="end"><label for="">End Time</label>
                  <input type="hidden" id="day">
              </div>
          </div>
          <div class="modal-footer-sm">
            <button href="#!" class="modal-close waves-effect waves-green btn" id="submit">Edit</button>
          </div>
        </div>
      </div>


    <!--JavaScript at end of body for optimized loading-->
    <script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/materialize/js/materialize.min.js"></script>
    <script type="text/javascript" src="/materialize/js/custom.js"></script>
  </body>
</html>
