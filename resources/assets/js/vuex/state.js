export const state = {
     selectedSchoolYear: 1,
     selectedSemester: '',
     loader: false,
      loaderMessage: '',
     checkCollectionPayment: true,
     checkCollectionTrainingPayment: true,
     startCollectionDate: '',
     endCollectionDate: '',
     editTrainingPayment: {
                firstname: '',
                lastname: '',
                paid_amount: 0,
                received_amount: 0,
                change: '',
                remarks: '',
                created_at: ''
            },
     paymentDate: '',
     trainingPayments:[],
     newTrainingDialog: false,
     loader: false,
     loaderMessage: '',
     confirmEnrolledId: '',
     balanceEnrollees: [],
     dueDate: '',
     payments:[],
     balance: null,
     balances: [],
     balance_ids:[],
     course_ids:[],
     giveAmount: 0,
     page: 1,
     authUser: {firstname: '', lastname: '', email: ''},
     studentType:[],
     confirmEnrolledPayment: null,
     confirmedEnrolled:{
        enrollee: {
            course_id: '',
            birthday: null,
            sex: 1,
            answers: {
                id: null,
                question: {
                    id: null
                }
            }

        },
        school_year_id: ''
     },
     password: '',
     enrollees: [],
     roles: ['default'],
     role: [],
     userLogin: false,
     registrationCompleted: false,
     startTime: '',
     endTime: '',
     birthday: '',
     siblings: null,
     snackbar: false,
     snackbarColor: '',
     snackbarText: '',
     provinces:[],
     dialogAdmission: false,
     schoolYears: [],
     yearLevel:[],
     semesters: [],
     schedules: [],
     courses: [],
     questions:[],
     requirements: [],
     policies:[],
     civilStatus: [],
     educAtt:[],
     items: [
                { icon: 'home', text: 'Home', to: '/' },
                {
                  icon: 'keyboard_arrow_up',
                  'icon-alt': 'keyboard_arrow_down',
                  text: 'About',
                  to: '/about-us',
                  model: false,
                  children: [
                    { text: 'School', to: '/school' },
                    { text: 'Students' , to: '/students'},
                    { text: 'Industry Partner', to: '/industry-partner' }
                  ]
                },
                { icon: 'assignment_ind', text: 'Admission', to: '/admission' },
                { icon: 'phone', text: 'Contact Us', to: '/contact-us'},
                { icon: 'tag_faces', text: 'Facebook Page', to: '/facebook-page' }
              ]
}