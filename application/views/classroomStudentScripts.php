<script type='text/javascript'>
    $(document).ready(function () {
        'use strict'

        var ALERT_PERCENTAGE = 0.12;
        var BAD_CLASS = 'danger';
        var GOOD_CLASS = 'success';


        // Model
        // ----------

        var Student = Backbone.Model.extend({

            defaults: {

            },

            initialize: function () {

            }

        });
        var Interval = Backbone.Model.extend({

            defaults: {

            },

            initialize: function () {
                this.set('Assignments', new Assignments(this.get('Assignments')), {slient: true})
            }

        });
        var Assignment = Backbone.Model.extend({
            urlRoot: '/GraderAide/Assignment/',

            idAttribute: 'Identifier',

            validate: function (attrs, options) {
                if (attrs.ExpectedScore != null && _.isNaN(parseInt(attrs.ExpectedScore))) {
                    return "ExpectedScore Must be a valid number";
                }
                if (attrs.CompletedScore != null && _.isNaN(parseInt(attrs.CompletedScore))) {
                    return "CompletedScore Must be a valid number";
                }
            },

            getAlertClass: function () {
                var exp = this.get('ExpectedScore'),
                    cmpl = this.get('CompletedScore');

                if (_.isNaN(parseInt(exp)) || _.isNaN(parseInt(cmpl)))
                    return;

                if (cmpl < (exp - exp * ALERT_PERCENTAGE))
                    return BAD_CLASS;

                if (cmpl > (exp + exp * ALERT_PERCENTAGE))
                    return GOOD_CLASS;

                return;
            }

        });

        // Collection
        // ---------------

        var Intervals = Backbone.Collection.extend({
            model: Interval

        });
        var Assignments = Backbone.Collection.extend({
            model: Assignment

        });


        var assignmentView = Backbone.View.extend({
            tagName: 'tr',

            template: _.template($('#Assignment').html()),

            events: {
                'click td'   : 'edit',
                'keypress td': 'updateOnEnter',
                'blur td'    : 'blurCell'
            },

            initialize: function () {
                this.listenTo(this.model, 'change', this.render);
            },

            render: function () {
                this.$el.html(this.template(this.model.toJSON()));
                this.$el.removeClass(GOOD_CLASS + ' ' + BAD_CLASS).addClass(this.model.getAlertClass())
                return this;
            },

            edit: function (e) {
                var $cell = $(e.currentTarget);

                setTimeout(function () {
                    $cell.addClass('edit');
                    $cell.find('input').focus();
                }, 0);
            },

            blurCell: function (e) {
                var cell = e.currentTarget,
                    $cell = $(cell),
                    value = $.trim($cell.find('input').val());

                $cell.removeClass('edit');

                switch (cell.className) {
                    case 'assignment-description':
                        this.model.save({Description: value}, {patch: true});
                        break;
                    case 'assignment-letter':
                        this.model.save({LetterGrade: value}, {patch: true});
                        break;
                    case 'assignment-completed':
                        this.model.save({CompletedScore: value === '' ? null : parseInt(value)}, {patch: true});
                        break;
                    case 'assignment-expected':
                        this.model.save({ExpectedScore: value == '' ? null : parseInt(value)}, {patch: true});
                        break;
                }
            },

            updateOnEnter: function (e) {
                if (e.keyCode == 13) this.blurCell(e);
            }
        });

        var tableSubject = Backbone.View.extend({
            tagName  : 'table',
            className: 'table table-striped table-hover table-condensed table-bordered table-responsive subject',

            template: _.template($('#TableSubject').html()),

            render: function () {
                this.$el.html(this.template(this.model));
                this.body = this.$('tbody');
                return this;
            }

        });


        // The Application
        // ---------------

        var content = Backbone.View.extend({

            el: "#classroomStudent",

            events: {
                'click': 'onClick'
            },

            subjects        : <?= $jsonsubjects ?>,
            subjectTables   : {},
            intervals       : new Intervals(<?= $jsonintervals ?>),
            subjectSummaries: <?= $subjectSummaries ?>,

            initialize: function () {
                this.weekTable = new this.weekTable();
            },

            render: function () {
                var self = this;

                self.weekTable.collection = self.intervals;
                self.weekTable.render();

                self.subjectContainer = self.$('#subjects');

                _.each(self.subjects, function (subject) {
                    var view = self.subjectTables[subject.Identifier] = new tableSubject({model: subject});

                    self.subjectContainer.append(view.render().el);
                });

                self.intervals.each(function (interval) {

                    interval.get('Assignments').each(function (assignment) {

                        self.subjectTables[assignment.get('SubjectIdentifier')]
                            .body.append(
                                new assignmentView({
                                    model: assignment
                                }).render().el
                            );
                    })
                });

                return self;
            },

            onClick: function () {
                this.$('table.subject td.edit').removeClass('edit');
            },

            weekTable: Backbone.View.extend({

                el: '#classroomStudentTableWeek',

                weekRowTemplate: _.template('<tr><td><%= Date %></td></tr>'),

                render: function () {
                    var self = this;
                    this.body = this.$('tbody');
                    this.collection.each(function (item) {
                        self.body.append(self.weekRowTemplate(item.toJSON()));
                    });

                    return self;
                }
            })

        });

        // Finally, we kick things off by creating the **App**.
        var App = new content;
        App.render();

    });

</script>