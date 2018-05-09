export const state = {
     authUser: [],
     userLogin: false,
     registrationCompleted: false,
     startTime: '',
     endTime: '',
     birthday: '',
     siblings: null,
     snackbar: false,
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
        { icon: 'home', text: 'Home' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'About',
          model: false,
          children: [
            { text: 'School' },
            { text: 'Students' },
            { text: 'DepEd' },
            { text: 'TESDA' },
            { text: 'Industry Partner' }
          ]
        },
        { icon: 'assignment_ind', text: 'Admission' },
        { icon: 'phone', text: 'Contact Us' },
        { icon: 'chat_bubble', text: 'Send feedback' },
        { icon: 'tag_faces', text: 'Facebook Page' }
      ]
}