<!DOCTYPE html>
<html>
    <head>
        <title>Welcome email</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <body>
        <table class="x_page" style="border-spacing:0; text-align:left; font-family:'Segoe UI',Helvetica,Arial,sans-serif; font-size:13px; background: lavender; margin:0; line-height:20px; width:676px; max-width:676px; table-layout:fixed">
            <tbody>
                <tr>
                    <td class="x_header" style="border-collapse:collapse; margin:0">
                        <table cellpadding="0" cellspacing="0" border="0" width="676">
                            <tbody>
                                <tr>
                                    <td width="45" valign="top" align="left" style="padding-bottom:13px">&nbsp;</td>
                                    <td width="420" align="left" style="font-family:'Segoe UI',Helvetica,Arial,sans-serif; font-size:10px; line-height:16px; color:#505050; padding-bottom:13px; ">
                                        <h1>{{$name}},</h1>
                                    </td>
                                    <td width="45" valign="top" align="left" style="padding-bottom:13px">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td class="x_main-container" style="border-collapse:collapse; margin:0; padding:0 40px">
                        <table style="border-spacing:0">
                            <tbody>
                                <tr>
                                    <td class="x_row" style="border-collapse:collapse; margin:0; padding:0 10px">
                                        <h1 style="font-weight:normal; color:#662879; font-size:2.1em"><span>Welcome to ProcessMaker</span></h1>
                                        <p style="margin:12px 0">Thanks for joining us. Here are a couple great ways to get started:</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="x_row x_product x_hero" style="border-collapse:collapse; margin:0; padding:10px 10px 20px; background-color:#eee">
                                        <table style="border-spacing:0">
                                            <tbody>
                                                <tr>
                                                    <td style="border-collapse:collapse; margin:0"><a href="{{$url}}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" class="x_hidden-link" style="text-decoration:none; color:#000"><img data-imagetype="External" src="https://i.ytimg.com/vi/VMzxoTAfeOI/maxresdefault.jpg" style="border:0; outline:none; width:12em"></a> </td>
                                                    <td style="border-collapse:collapse; margin:0; padding-left:10px">
                                                        <h2 style="font-weight:normal; font-size:1.6em"><a href="{{$url}}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" class="x_hidden-link" style="text-decoration:none; color:#000">ProcessMaker Designer</a></h2>
                                                        <p style="margin:12px 0"><span>Collaborate in the cloud with our online designers, agile, continuous delivery.</span>  </p>
                                                        <table class="x_button-table" style="border-spacing:0">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="border-collapse:collapse; margin:0; padding:4px 20px 6px; color:#fefefe; background-color:#008a01; text-align:center; height:26px">
                                                                        <a href="{{$url}}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" class="x_button" style="text-decoration:none; color:#fefefe; background-color:#008a01; line-height:30px">Start your project</a> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="x_row x_product" style="border-collapse:collapse; margin:0; padding:10px 10px 20px">
                                        <table style="border-spacing:0">
                                            <tbody>
                                                <tr>
                                                    <td style="border-collapse:collapse; margin:0">
                                                        <h2 style="font-weight:normal; font-size:1.6em"><a href="{{$url}}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" class="x_hidden-link" style="text-decoration:none; color:#000">ProcessMaker 4</a></h2>
                                                        <p style="margin:12px 0"><span>Get everything need to build and deploy your app on BPM platform. With state-of-the-art tools, the power of the cloud, training, and support, it's our most comprehensive developer program ever.</span> <a href="{{$url}}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable">More information</a> </p>

                                                    </td>
                                                    <td style="border-collapse:collapse; margin:0; padding-left:10px"><a href="{{$url}}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" class="x_hidden-link" style="text-decoration:none; color:#000"></a> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="x_footer" style="border-collapse:collapse; margin:0">
                        <table cellpadding="0" cellspacing="0" border="0" width="676">
                            <tbody>
                                <tr>
                                    <td width="45" valign="top" align="left" style="padding-bottom:13px">&nbsp;</td>
                                    <td width="631" align="left" style="font-family:'Segoe UI',Helvetica,Arial,sans-serif; font-size:10px; line-height:16px; color:#505050; padding-bottom:13px">
                                        <br>
                                        <br>
                                        This message from ProcessMaker is an important part of a program, service, or product that you or your company purchased or participate in. ProcessMaker respects your privacy. Please read our <a href="{{$url}}" target="_blank" rel="noopener noreferrer" data-auth="NotApplicable" title="Privacy Statement" style="color:#0060a6; text-decoration:none">Privacy Statement</a>. 

                                        <br>
                                        <br>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
