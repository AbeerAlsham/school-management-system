<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>Excel To HTML using codebeautify.org</title>
    <style>
        body {
            direction: rtl;
            /* تحويل الكتابة من اليمين إلى اليسار */
            text-align: right;
            /* محاذاة النص إلى اليمين */
        }

        .header {
            display: flex;
            /* استخدام flexbox */
            justify-content: space-between;
            /* توزيع العناصر بالتساوي */
            align-items: center;
            /* محاذاة العناصر عموديًا */
            margin-bottom: 20px;
            /* إضافة مسافة أسفل الرأس */
        }

        .header div {
            flex: 1;
            /* جعل كل عنصر يأخذ مساحة متساوية */
            text-align: center;
            /* محاذاة النص في الوسط */
        }

        table {
            width: 100%;
            /* جعل الجدول بعرض الصفحة */
            border-collapse: collapse;
            /* دمج الحدود */
        }

        td {
            padding: 10px;
            /* إضافة مساحة داخل الخلايا */
            border: 1px solid black;
            /* إضافة حدود للخلايا */
        }

        .center {
            text-align: center;
            /* محاذاة النص إلى الوسط */
        }

        .info-row {
            display: flex;
            /* استخدام flexbox لجعل العناصر في نفس السطر */
            margin-bottom: 10px;
            /* إضافة مسافة أسفل السطر */
        }

        .info-item {
            margin: 0 50px;
            /* إضافة مسافة بين العناصر */
        }
    </style>
</head>

<body>
    <div class="info-row">
        <div class="info-item">مديرية التربية في محافظة ريف دمشق</div>
        <div class="info-item">محصلة الفصل للعام الدراسي</div>
        <div class="info-item">المادة</div>
    </div>

    <!-- السطر الجديد -->
    <div class="info-row">
        <div class="info-item">مدرسة عربين السادسة حلقة ثانية</div>
        <div class="info-item">الصف</div>
        <div class="info-item">الشعبة</div>
        <div class="info-item">الدرجة</div>
    </div>

    <table cellspacing="0" border="1">
        <tr>
            <td rowspan="3" style="min-width:50px">تسلسل</td>
            <td rowspan="3" colspan="3" style="min-width:50px">اسم الطالب</td>
            <td colspan="4" style="min-width:50px">% درجة أعمال الفصل 60</td>
            <td rowspan="2" class="center" style="min-width:50px">مجموع درجة أعمال الفصل</td>
            <!-- محاذاة النص في هذه الخلية -->
            <td rowspan="2" class="center" style="min-width:50px">امتحان الفصل</td>
            <!-- محاذاة النص في هذه الخلية -->
            <td rowspan="2" colspan="2" class="center" style="min-width:50px">مجموع درجات الأعمال والمذاكرة للفصل
            </td> <!-- محاذاة النص في هذه الخلية -->
        </tr>
        <tr>
            <td style="min-width:50px">شفهي</td>
            <td style="min-width:50px">وظائف + أوراق عمل</td>
            <td style="min-width:50px">نشاطات و مبادرات</td>
            <td style="min-width:50px">المذاكرة</td>
        </tr>
        <tr>
            <td style="min-width:50px">10%</td>
            <td style="min-width:50px">10%</td>
            <td style="min-width:50px">20%</td>
            <td style="min-width:50px">20%</td>
            <td style="min-width:50px">40%</td>
            <td style="min-width:50px">100%</td>
            <td style="min-width:50px">رقماً</td>
            <td style="min-width:50px">كتابةً</td>
        </tr>
    </table>

</body>

</html>
<?php /**PATH C:\laragon\www\example-app11\resources\views/SubjectMarks.blade.php ENDPATH**/ ?>