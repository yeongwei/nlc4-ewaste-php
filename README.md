# E-Waste Management Application

Making E-Waste recycling fun!

# Database Schema

The prototyped schema in JSON:

```json
[
  '{{repeat(2, 1)}}',
  {
    _id: '{{objectId()}}',
    index: '{{index()}}',
    guid: '{{guid()}}',
    isActive: '{{bool()}}',
    age: '{{integer(20, 40)}}',
    gender: '{{gender()}}',
    name: '{{firstName()}} {{surname()}}',
    company: '{{company().toUpperCase()}}',
    role: function (tags) {
      var _role = ['user', 'collector', 'regulator', 'admin'];
      return _role[tags.integer(0, _role.length - 1)];
    },
    email: '{{email()}}',
    phone: '+1 {{phone()}}',
    address: '{{integer(100, 999)}} {{street()}}',
    city: '{{city()}}',
    postcode: '{{integer(10000,99999)}}',
    state: '{{state()}}',
    registered: '{{date(new Date(2014, 0, 1), new Date(), "YYYY-MM-ddThh:mm:ss Z")}}',
    latitude: '{{floating(-90.000001, 90)}}',
    longitude: '{{floating(-180.000001, 180)}}',
    weight: '{{floating(0,100)}}',
    isLocked: '{{bool()}}',
    status: function (tags) {
      var _status = ['in-progress', 'completed', 'confirmed'];
      return _status[tags.integer(0, _status.length - 1)];
    }
  }
]
```
