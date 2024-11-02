{{-- {{ $admission['patientRooms'] }} --}}
<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patient Discharge </title>
</head>

<body>
    <table style="border: 1px solid black;border-collapse: collapse">
        <tr>
            <td >
                <img src="images/hms_logo.jpg" alt="logo" width="100" />
            </td>
            <td >
                <h2>مشفى ابن النفيس</h2>
            </td>
        </tr>
    </table>

    <br>
    <div style="text-align: center;">تخريج مريض</div>
    <div >
        <div> معلومات المريض:</div>
        <table style="border: 1px solid black;border-collapse: collapse">
            <thead>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        الاسم
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">تاريخ الميلاد</td>
                    <td style="border: 1px solid black;border-collapse: collapse">الجنس</td>
                    <td style="border: 1px solid black;border-collapse: collapse">الأمراض المزمنة</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        {{ $patient['first_name'] }} {{ $patient['last_name'] }}
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $patient['birthday'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $patient['gender'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $patient['medical_history'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div >
        <div> معلومات دخول المريض:</div>
        <table style="border: 1px solid black;border-collapse: collapse">
            <thead>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        تاريخ الدخول
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">تاريخ الخروج</td>
                    <td style="border: 1px solid black;border-collapse: collapse">الطبيب الموافق</td>
                    <td style="border: 1px solid black;border-collapse: collapse"> سبب التخريج</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        {{ $admission['admission_date'] }}
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $admission['discharge_date'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $admission['doctor']['first_name'] }} {{ $admission['doctor']['last_name'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $admission['discharge_reason'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div >
        <div>الغرف التي حجزها المريض:</div>
        <table style="border: 1px solid black;border-collapse: collapse">
            <thead>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        رقم الغرفة
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">تاريخ دخول الغرفة</td>
                    <td style="border: 1px solid black;border-collapse: collapse">تاريخ الخروج من الغرفة</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($admission['patientRooms'] as $room)
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        {{ $room['room']['number'] }}
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $room['entry_date'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $room['exit_date'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div >
        <div>المعاينات التي أجراها المريض:</div>
        <table style="border: 1px solid black;border-collapse: collapse">
            <thead>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        التشخيص
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">الدواء</td>
                    <td style="border: 1px solid black;border-collapse: collapse">الدكتور</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($admission['inspections'] as $inspection)
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        {{ $inspection['diagnose'] }}
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $inspection['medicine'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $inspection['doctor']['first_name'] }}{{ $inspection['doctor']['last_name'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div >
        <div>التحاليل التي أجراها المريض:</div>
        <table style="border: 1px solid black;border-collapse: collapse">
            <thead>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        التحليل
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">النتيجة</td>
                    <td style="border: 1px solid black;border-collapse: collapse">التاريخ</td>
                    <td style="border: 1px solid black;border-collapse: collapse">الدكتور</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($admission['patientTests'] as $test)
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        {{ $test['test']['name'] }}
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $test['result'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $test['date'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $test['doctor']['first_name'] }}{{ $test['doctor']['last_name'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div >
        <div>الأشعة التي أجراها المريض:</div>
        <table style="border: 1px solid black;border-collapse: collapse">
            <thead>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        الأشعة
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">النتيجة</td>
                    <td style="border: 1px solid black;border-collapse: collapse">التاريخ</td>
                    <td style="border: 1px solid black;border-collapse: collapse">الدكتور</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($admission['patientRays'] as $ray)
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        {{ $ray['ray']['name'] }}
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $ray['result'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $ray['date'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $ray['doctor']['first_name'] }}{{ $ray['doctor']['last_name'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div >
        <div>العمليات التي أجراها المريض:</div>
        <table style="border: 1px solid black;border-collapse: collapse">
            <thead>
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        العملية
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">النتيجة</td>
                    <td style="border: 1px solid black;border-collapse: collapse">التاريخ</td>
                    <td style="border: 1px solid black;border-collapse: collapse">نوع التخدير</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($admission['surgeries'] as $surgery)
                <tr>
                    <td style="border: 1px solid black;border-collapse: collapse">
                        {{ $surgery['name'] }}
                    </td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $surgery['result'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $surgery['date'] }}</td>
                    <td style="border: 1px solid black;border-collapse: collapse">{{ $surgery['anesthesia_type'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


<br>
    <table>
        <tr>
            <td>
                التاريخ:
            </td>
            <td>
                التوقيع:
            </td>
        </tr>
    </table>
</body>

</html>
