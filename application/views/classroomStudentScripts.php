<script type='text/javascript'>
    $(document).ready(function () {
        'use strict'


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

//            initialize: function () {
//
//            }

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

            template: _.template(
                '<td class="assignment-description"><%= Description %></td>' +
                    '<td class="assignment-letter"><%= LetterGrade %></td>' +
                    '<td class="assignment-completed"><%= CompletedScore %></td>' +
                    '<td class="assignment-expected"><%= ExpectedScore %></td>'
            ),

            events: {
                'click td'   : 'edit',
                'keypress td': 'updateOnEnter'

            },

            initialize: function () {
                this.listenTo(this.model, 'change', this.render);
            },

            render: function () {
                this.$el.html(this.template(this.model.toJSON()));
                return this;
            },

            edit         : function () {
                this.$el.addClass('editing');
                this.input.focus();
            },

            // Close the `'editing'` mode, saving changes to the todo.
            close        : function () {
                var value = this.input.val();
                if (!value) {
                    this.clear();
                } else {
                    this.model.save({title: value});
                    this.$el.removeClass('editing');
                }
            },

            // If you hit `enter`, we're through editing the item.
            updateOnEnter: function (e) {
                if (e.keyCode == 13) this.close();
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

            },

            subjects     : <?= $jsonsubjects ?>,
            subjectTables: {},
            intervals    : new Intervals(<?= $jsonintervals ?>),

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