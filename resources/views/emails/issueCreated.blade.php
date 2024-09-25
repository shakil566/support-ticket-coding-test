
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{ trans('english.PROJECT_TITLE') }}</title>

</head>

<body bgcolor="#FFFFFF">

    <table class="body-wrap">
        <tr>
            <td></td>
            <td class="container" bgcolor="#FFFFFF">

                <div class="content">
                    <table>
                        <tr>
                            <td>
                                <h3>Dear Admin,</h3>
                                <p class="lead">A new support ticket has been created, please check details.</p>

                                <p><strong>Customer Name:</strong> {{ $issue->user->name }}</p>
                                <p><strong>Support Ticket Number:</strong> {{ $issue->ticket_number }}</p>
                                <p><strong>Address:</strong> {{ $issue->address }}</p>
                                <p><strong>Details:</strong> {{ $issue->details }}</p>
                                <p><strong>Status:</strong> {{ $issue->status }}</p>
                            </td>
                        </tr>
                    </table>
                </div><!-- /content -->

            </td>
            <td></td>
        </tr>
    </table><!-- /BODY -->

    <!-- FOOTER -->
    <table class="footer-wrap">
        <tr>
            <td></td>
            <td class="container">

                <!-- content -->
                <div class="content">
                    <table>
                        <tr>
                            <td align="center">
                                <p>
                                    Copyright © <?php echo date('Y'); ?> {{ env('APP_NAME') }}
                                </p>
                            </td>
                        </tr>
                    </table>
                </div><!-- /content -->

            </td>
            <td></td>
        </tr>
    </table><!-- /FOOTER -->

</body>

</html>
