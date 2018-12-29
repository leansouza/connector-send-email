<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>{{$subject}}</title>

  <style>
    body {
    }
    .email-wrapper {
      background-color: white;
      font-size: 15px;
      font-family: Arial, Helvetica, sans-serif;
    }

    .header {
      text-align: center;
    }

    .email-body-wrapper {
      padding: 20px;
      /* display: flex; */
    }

    .center-block {
      width: auto;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto
    }

    .container {
      color: black;
    }

    a.btn {
      color: white;
    }

    .btn {
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      text-decoration: none;
      display: inline-block;
    }

    .btn:hover {
      color: white;
      background-color: #0069d9;
    }

    .btn-primary {
      background-color: #3397e1;
    }

    a.text-light {
      text-decoration: none;
      color: #f8f9fa;
    }

    a.text-light:hover {
      text-decoration: underline;
      color: #dae0e5;
    }

    .row {
      /* display: flex; */
      width: 100%;
      clear: both;
      overflow: auto;
    }

    .col {
      width: 50%;
      float: left;
    }

    .form-group {
      padding-bottom: 10px;
    }

    .record-list table {
      width: 100%;
      border-collapse: collapse;
    }

    .record-list td {
      padding: 3px;
    }

    .record-list thead {
      text-align: left;
      border-bottom: 1px solid black;
      background-color: #3397e1;
      color: white;
      font-weight: bold;
    }

    .record-list th {
      font-weight: normal;
      padding: 3px;
    }

    .record-list tbody tr {
      text-align: left;
      border-bottom: 1px solid lightgray;
    }

    @media (max-width: 500px) {

      .email-body-wrapper {
        padding: 0;
      }
      .center-block {
        width: auto;
        min-width: auto;
      }

      .footer-1 .logo {
        max-width: 100%;
        height: auto;
      }

      .footer-2 .col {
        float: none;
        width: auto;
      }
    }
  </style>

</head>

<body>
  <div class="email-wrapper">
    <div class="container">
      <div class="header">
        <a href="https://www.processmaker.com" class="btn btn-primary">
          SENT BY PROCESSMAKER 4
        </a>
      </div>

      <div class="email-body-wrapper">
        <div class="email-body center-block">
          {!! $body !!}
        </div>
      </div>

      <div class="footer-1" style="background-color: #3397e1; padding:20px 10px; text-align: center;">
        <a href="https://www.processmaker.com">
          <img class="logo" alt="ProcessMaker" src="{{ $message->embed(public_path('vendor/processmaker/connectors/email/img/logo-big.png')) }}" />
        </a>
        <table align="center"><tr>
          <td style="padding:20px 10px">
            <a href="http://twitter.com/processmaker">
              <img class="logo" alt="Twitter" src="{{ $message->embed(public_path('vendor/processmaker/connectors/email/img/twitter.png')) }}" />
            </a>
          </td>
          <td style="padding:20px 10px">
            <a href="https://www.facebook.com/processmaker">
              <img class="logo" alt="Facebook" src="{{ $message->embed(public_path('vendor/processmaker/connectors/email/img/facebook.png')) }}" />
            </a>
          </td>
          <td style="padding:20px 10px">
            <a href="http://www.youtube.com/processmaker#play/uploads">
              <img class="logo" alt="YouTube" src="{{ $message->embed(public_path('vendor/processmaker/connectors/email/img/youtube.png')) }}" />
            </a>
          </td>
          <td style="padding:20px 10px">
            <a href="https://www.linkedin.com/company/113435/">
              <img class="logo" alt="LinkedIn" src="{{ $message->embed(public_path('vendor/processmaker/connectors/email/img/linkedin.png')) }}" />
            </a>
          </td>
        </tr></table>
      </div>
      <div class="footer-2" style="background-color: #2481c5; color: #fff; padding:30px 10px ">
        <div class="center-block" style="max-width: 500px">
          <div align="center">
            <h4>
              Get the ProcessMaker workflow app
            </h4>
            <div class="row" style="">
              <div class="col">
                <a align="center" href="https://itunes.apple.com/us/app/processmaker/id992576284?ls=1&amp;mt=8">
                  <img class="logo" alt="Apple App Store" src="{{ $message->embed(public_path('vendor/processmaker/connectors/email/img/appstore.png')) }}" />
                </a>
              </div>
              <div class="col">
                <a align="center" href="https://play.google.com/store/apps/details?id=com.colosa.processmaker">
                  <img class="logo" alt="Google Play" src="{{ $message->embed(public_path('vendor/processmaker/connectors/email/img/googleplay.png')) }}" />
                </a>
              </div>
            </div>

            <div align="center">
              <a href="https://www.processmaker.com/privacy-statement" class="text-light">
                Privacy Statement
              </a>
              &nbsp;|&nbsp;
              <a href="https://www.processmaker.com/security-statement" class="text-light">
                Security Statement
              </a>
              &nbsp;|&nbsp;
              <a href="https://www.processmaker.com/gdpr" class="text-light">
                GDPR
              </a>
              &nbsp;|&nbsp;
              <a href="https://www.processmaker.com/terms-of-service" class="text-light">
                Terms of Service
              </a>

              <br>
              © Copyright 2000 - 2019 ProcessMaker Inc.
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>