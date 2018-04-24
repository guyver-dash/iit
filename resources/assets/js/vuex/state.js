export const state = {
     dialogAdmission: false,
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