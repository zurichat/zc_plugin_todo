import { SubscribeToChannel } from 'zuricontrol';
// `wywmtd` what you want me to do callback function
const CentrifugeSetup = (channel, wywmtd) => {
  SubscribeToChannel(channel, wywmtd);
};
export default CentrifugeSetup;
