export const state = {
     payments:[],
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
     roles: [],
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
            { text: 'School' },
            { text: 'Students' },
            { text: 'DepEd' },
            { text: 'TESDA' },
            { text: 'Industry Partner' }
          ]
        },
        { icon: 'assignment_ind', text: 'Admission', to: '/admission' },
        { icon: 'phone', text: 'Contact Us', to: '/contact-us'},
        { icon: 'chat_bubble', text: 'Send feedback', to: 'feedback' },
        { icon: 'tag_faces', text: 'Facebook Page', to: 'facebook-page' }
      ]
}