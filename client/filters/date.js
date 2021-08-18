import moment from 'moment';

export default function (value) {
  const dateFromValue = moment(value * 1000);

  const today = moment().startOf('day');
  const yesterday = moment().subtract(1, 'days').startOf('day');

  if (dateFromValue.isSame(today, 'd')) {
    return 'today';
  } else if (dateFromValue.isSame(yesterday, 'd')) {
    return 'yesterday';
  } else {
    return dateFromValue.format('D MMMM YYYY');
  }
}
