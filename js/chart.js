var Chart = {

    options: {},
    studentObj: {},
    data: {},
    chart: {},
    init: function()
    {
        google.load("visualization", "1", {packages:["corechart"]});
    },
    drawChart: function(studentId, classroomId, subjectId) {
        this.studentObj = JSON.parse(document.getElementById(studentId).innerHTML);
        var intervals = this.studentObj.Intervals.filter(function(x) { return x.ClassroomIdentifier == classroomId; });
        var gradeData = [['Week', 'Expected', 'Completed']];

        var totalExpected = 0;
        var totalCompleted = 0;

        for(i = 0, ii = intervals.length; i < ii; i++)
        {
            var assignments = intervals[i].Assignments.filter(function(x) { return x.SubjectIdentifier == subjectId; });
            for(j = 0, jj = assignments.length; j < jj; j++)
            {
                totalExpected += parseFloat(assignments[j].ExpectedScore);
                totalCompleted += parseFloat(assignments[j].CompletedScore);
            }
            gradeData.push([intervals[i].Date, totalExpected, totalCompleted]);
        }
        this.data = google.visualization.arrayToDataTable(gradeData),

        this.options = {
            title: this.studentObj.FirstName
        },

        this.chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        this.chart.draw(this.data, this.options)
    }
}
Chart.init();