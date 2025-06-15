<x-layout.main>
    @vite(['public/css/dashboard.css'])
    <div class="table">
        <table style="border: 1px solid;">
            <tr>
                <th colspan="6">My personal dashboard</th>
            </tr>
            <tr>
                <th>Quartile</th>
                <th>Subject</th>
                <th>Course number</th>
                <th>Credit</th>
                <th class="exam">Exam</th>
                <th>Grade</th>
            </tr>
            <tr>
                <th rowspan="3">Block 1</th>
                <td>Program & Career Orientation (PCO)</td>
                <td>CU75001</td>
                <td>2.5 EC</td>
                <td>Assessment website</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Computer Science Basics (CSB)</td>
                <td>CU75002</td>
                <td>5 EC</td>
                <td>Written exam</td>
                <td>-</td>
            </tr>
            <tr>
                <td>Programming Basics (PB)</td>
                <td>CU75003</td>
                <td>5 EC</td>
                <td>Case study exam</td>
                <td>-</td>
            </tr>
            <tr>
                <th rowspan="2">Block 2</th>
                <td rowspan="2">Object Oriented Programming (OOP)</td>
                <td rowspan="2">CU75004</td>
                <td rowspan="2">10 EC</td>
                <td>Group assignment</td>
                <td> - </td>
            </tr>
            <tr>
                <td>Case study exam</td>
                <td> - </td>
            </tr>
            <tr>
                <th rowspan="4">Block 3</th>
                <td rowspan="4">Framework Project 1</td>
                <td rowspan="4">CU75080</td>
                <td rowspan="4">10 EC</td>
                <td>On-site case study exam</td>
                <td> - </td>
            </tr>
            <tr>
                <td>Database exam </td>
                <td> - </td>
            </tr>
            <tr>
                <td>Group presentation on project result</td>
                <td> - </td>
            </tr>
            <tr>
                <td>Group portfolio with individual elements on requirements</td>
                <td> - </td>
            </tr>
            <tr>
                <th rowspan="3">Block 4</th>
                <td rowspan="3">Framework Project 2</td>
                <td rowspan="3">CU75011</td>
                <td rowspan="3">10 EC</td>
                <td>Final delivery</td>
                <td> - </td>
            </tr>
            <tr>
                <td>Report of acceptance tests and optional assessments</td>
                <td> - </td>
            </tr>
            <tr>
                <td>IT Development portfolio</td>
                <td> - </td>
            </tr>
            <tr>
                <th>Block 3 & 4</th>
                <td>Bussiness IT Consultancy Basics</td>
                <td>CU75081</td>
                <td>2.5 EC</td>
                <td>Video</td>
                <td> - </td>
            </tr>
            <tr>
                <th rowspan="2">Year 1</th>
                <td>Personal Professional Development Exploration</td>
                <td>CU75068</td>
                <td>12.5 EC</td>
                <td>Criterium focused interview</td>
                <td> - </td>
            </tr>
            <tr>
                <td>IT personality</td>
                <td> - </td>
                <td>2.5 EC</td>
                <td>Portfolio</td>
                <td> - </td>
            </tr>
        </table>

        <p class="dashboard-info">NSBA (Negative binding study advice) - You must have completed at least 45 out of 60 EC in
            order to pass your first year.</p>
    </div>
    <section class="dashboard-bar">
        <p>Study monitor</p>
        <div class="progress-bar">
            <div class="progress-level" style="width: 10%"></div>
        </div>
    </section>
    <center id="NBSA">
        <p>| <br>
        <p>45EC - *NBSA</p>
        </p>
    </center>
</x-layout.main>
